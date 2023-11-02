<?php

namespace App\DataTables;

use App\Models\AddClass;
use App\Models\StudentAttendanceStatus;
use Illuminate\Support\Facades\Auth;

class MyAttendanceDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->editColumn('attendance_date_id', function ($model) {
                $formattedDate = date('M d, Y', strtotime($model->attendance->attendance_date));
                return $formattedDate;
            })
            ->editColumn('status', function ($model) {
                if ($model->status == 1) {
                    return '<span class="badge badge-success">Present</span>';
                } elseif ($model->status == 2) {
                    return '<span class="badge badge-danger">Absent</span>';
                } elseif ($model->status == 3) {
                    return '<span class="badge badge-warning">late Entry</span>';
                } elseif ($model->status == 4) {
                    return '<span class="badge badge-info">Permission</span>';
                }
            })
            ->rawColumns(['status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\StudentAttendanceStatus $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StudentAttendanceStatus $model)
    {
        $student_id = Auth::user()->id;
        $attendanceDates = $model->with('attendance')->where('student_id', $student_id)->get();

        return $attendanceDates;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        // $params = $this->getBuilderParameters();
        $params['order'] = [[0, 'asc']];
        $params['rowReorder'] =  false;
        $params['pageLength'] = 15;
        $params['buttons'] = [];
        $actionParam['width'] = '210px';
        $params['stateSave'] = true;


        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($params);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            'index' => ['title' => '#', 'data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
            'attendance_date_id' => ['title' => 'Attendance Date'],
            'status',
        ];
        return  $columns;
    }
}
