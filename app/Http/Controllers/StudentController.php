<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function showCSVForm()
    {
        return view('layouts.app');
    }

    public function import(Request $request)
    {
        $file = $request->csvFile;
        $path = public_path('uploads/csv');
        $fileOriginalName = $file->getClientOriginalName();
        $file->move($path, $fileOriginalName);

        if (strtolower($file->guessClientExtension()) == 'xlsx' || strtolower($file->guessClientExtension()) == 'csv') {
            Excel::import(new UsersImport, $path . '/' . $fileOriginalName);
            $output['messege'] = 'Student has been created';
            $output['msgType'] = 'success';
        } else {
            if (strtolower($file->guessClientExtension()) == 'bin') {
                $output['messege'] = 'Give maximum 8000 row at a file.';
                $output['msgType'] = 'danger';
            } else {
                echo json_encode(['errorMsg' => 'File is not CSV. This file format is ' . $file->guessClientExtension() . '.']);
                $output['messege'] = 'File is not CSV. This file format is ' . $file->guessClientExtension();
                $output['msgType'] = 'danger';
            }
        }
    }
}
