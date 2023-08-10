<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsPaymentExport implements FromCollection, WithHeadings
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }
    public function collection()
    {
        return collect($this->students);
        }

    public function headings(): array
    {
        return array_keys($this->students[0]);
        // $feeTypes = $this->fees;
        // return [
        //     'Student name',
        //     'Email',
        //     'NIC',
        //     'Mobile',
        //     'Address line 1',
        //     'Address line 2',
        //     'Address line 3',
        //     'City',
        //     'Course',
        //     'Intake',
        //     ...$feeTypes
        // ];
    }
    // public function getFeeTypes(): array
    // {
    //     $feeTypes = [];

    //     foreach ($this->students as $student) {
    //         foreach ($student->feese as $fee) {
    //             $feeTypes[$fee->id] = $fee->fee_type;
    //         }
    //     }

    //     return $feeTypes;
    // }
}
