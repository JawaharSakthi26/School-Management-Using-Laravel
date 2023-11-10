<?php

namespace App\Exports\Admin;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassTeacherExport implements FromCollection, WithHeadings
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
                'Class Name' => $teacher->class->name ?? '',
                'Teacher name' => $teacher->teacher->name ?? '',
                'Assigned By' => $teacher->user->name ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Class Name',
            'Teacher name',
            'Assigned By',
        ];
    }
}
