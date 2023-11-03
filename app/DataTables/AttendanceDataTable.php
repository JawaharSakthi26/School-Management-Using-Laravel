<?php

namespace App\DataTables;

use App\Models\AddClass;
use App\Models\StudentAttendance;
use App\Models\StudentAttendanceStatus;
use Illuminate\Support\Facades\Auth;

class AttendanceDataTable extends BaseDataTable
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
            ->addColumn('attendance_date', function ($model) {
                return \Carbon\Carbon::parse($model->attendance_date)->format('M d, Y');
            })
            ->addColumn('present', function ($model) {
                $presentCount = $model->statuses
                    ->where('status', '1')
                    ->count();
            
                return $presentCount;
            })
            ->addColumn('absent', function ($model) {
                $presentCount = $model->statuses
                    ->where('status', '2')
                    ->count();
            
                return $presentCount;
            })
            ->addColumn('late_entry', function ($model) {
                $presentCount = $model->statuses
                    ->where('status', '3')
                    ->count();
            
                return $presentCount;
            })
            ->addColumn('permission', function ($model) {
                $presentCount = $model->statuses
                    ->where('status', '4')
                    ->count();
            
                return $presentCount;
            })

            ->addColumn('action', function ($model) {
                $id = $model->id;
                $action = '<a href="' . route('attendance.edit', $id) . '" class="btn btn-sm bg-success-light me-2"> <i class="feather-edit"></i> </a> &nbsp;';
                $action .= '<form action="' . route('attendance.destroy', $id) . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm bg-danger-light"><i class="feather-trash"></i></button>
                            </form>&nbsp;';
                return $action;
            })
            ->rawColumns(['attendance_date', 'action']);
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\StudentAttendance $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(StudentAttendance $model)
    {
        $attendanceDates = $model->with('statuses')->where('user_id', Auth::user()->id)->orderBy('attendance_date', 'desc')->get();
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
            ->addAction($this->getActionParamters())
            ->parameters($params);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'index' => ['title' => '#', 'data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
            'attendance_date' => ['title' => 'Attendance Date'],
            'present' => ['title' => 'Present'],
            'absent' => ['title' => 'Absent'],
            'late_entry' => ['title' => 'Late Entry'],
            'permission' => ['title' => 'Permission'],

        ];
    }
}