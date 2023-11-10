<?php

namespace App\Exports\Teacher;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $attendance;

    public function __construct($attendance)
    {
        $this->attendance = $attendance;
    }

    public function collection()
    {
        $attendanceCounts = [];

        foreach ($this->attendance as $attendance) {
            $attendanceDate = $attendance->attendance_date;

            if (!isset($attendanceCounts[$attendanceDate])) {
                $attendanceCounts[$attendanceDate] = [
                    'Present' => 0,
                    'Absent' => 0,
                    'Late Entry' => 0,
                    'Permission' => 0,
                ];
            }

            if ($attendance->statuses && $attendance->statuses->isNotEmpty()) {
                foreach ($attendance->statuses as $status) {
                    switch ($status->status) {
                        case '1':
                            $attendanceCounts[$attendanceDate]['Present']++;
                            break;
                        case '2':
                            $attendanceCounts[$attendanceDate]['Absent']++;
                            break;
                        case '3':
                            $attendanceCounts[$attendanceDate]['Late Entry']++;
                            break;
                        case '4':
                            $attendanceCounts[$attendanceDate]['Permission']++;
                            break;
                    }
                }
            }
        }

        $collection = [];

        foreach ($attendanceCounts as $date => $counts) {
            $collection[] = [
                'Attendance Date' => $date,
                'Present' => $counts['Present'] < 1 ? '0' : $counts['Present'],
                'Absent' => $counts['Absent'] < 1 ? '0' : $counts['Absent'],
                'Late Entry' => $counts['Late Entry'] < 1 ? '0' : $counts['Late Entry'],
                'Permission' => $counts['Permission'] < 1 ? '0' : $counts['Permission'],
            ];
        }

        return collect($collection);
    }



    public function headings(): array
    {
        return [
            'Attendance date',
            'Present',
            'Absent',
            'Late Entry',
            'Permission',
        ];
    }
}
