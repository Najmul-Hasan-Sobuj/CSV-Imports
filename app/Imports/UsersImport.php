<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Student([
            'student_id'   => $row[0],
            'student_name' => $row[1],
            'section'      => $row[2],
            'batch'        => $row[3],
        ]);
    }
}
