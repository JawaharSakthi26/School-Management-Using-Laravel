<?php

namespace App\Exports\Admin;

use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeacherExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $teachers;

    public function __construct($teachers)
    {
        $this->teachers = $teachers;
    }

    public function collection()
    {
        return $this->teachers->map(function ($teacher) {
            return [
                'Name' => $teacher->user->name ?? '',
                'Email ID' => $teacher->user->email ?? '',
                'Phone' => $teacher->phone ?? '',
                'Date of Birth' => $teacher->dob ?? '',
                'Gender' => Config::get('custom.genderOptions.' . $teacher->gender, ''),
                'Blood Group' => $teacher->blood_group ?? '',
                'Qualification' => $teacher->qualification ?? '',
                'Joining Date' => $teacher->joining_date ?? '',
                'Address' => $teacher->address . ', ' . $teacher->city . ', ' . $teacher->state ?? '', 
                'Zip Code' => $teacher->zip_code ?? '',
                'Country' => $teacher->country ?? '',
                'Status' => $teacher->status == '1' ? 'Active' : 'Inactive' ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email ID',
            'Phone',
            'Date of Birth',
            'Gender',
            'Blood Group',
            'Qualification',
            'Joining Date',
            'Address',
            'Zip Code',
            'Country',
            'Status'
        ];
    }
}
