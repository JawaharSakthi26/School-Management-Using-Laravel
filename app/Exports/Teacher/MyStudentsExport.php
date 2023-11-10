<?php

namespace App\Exports\Teacher;

use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MyStudentsExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return $this->students->map(function ($student) {
            return [
                'Admission ID' => $student->admission_id,
                'Roll Number' => $student->roll_number,
                'Name' => $student->user->name ?? '',
                'Email ID' => $student->user->email ?? '',
                'Phone' => $student->phone ?? '',
                'Gender' => Config::get('custom.genderOptions.' . $student->gender, ''),
                'Religion' => Config::get('custom.religionOptions.' . $student->religion, ''),
                'Blood Group' => $student->blood_group ?? '',
                'Address' => $student->address . ', ' . $student->city . ', ' . $student->state ?? '', 
                'Zip Code' => $student->zip_code ?? '',
                'Country' => $student->country ?? '',
                'Status' => $student->status == '1' ? 'Active' : 'Inactive' ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Admission ID',
            'Roll Number',
            'Name',
            'Email ID',
            'Phone',
            'Gender',
            'Religion',
            'Blood Group',
            'Address',
            'Zip Code',
            'Country',
            'Status'
        ];
    }
}
