<?php

namespace App\DataTables;

use App\Models\ClassTeacher;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class MyStudentsDataTable extends BaseDataTable
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
            ->editColumn('user_name', function ($model) {
                $imagePath = asset('uploads/' . $model->user->avatar);
                $userImage = '<img class="avatar-img rounded-circle" src="' . $imagePath . '" width="40" height="40" >';
                $userName = $model->user->name ?? '';
                return $userImage . ' ' . $userName;
            })
            ->editColumn('phone', function ($model) {
                return $model->phone ?? '';
            })
            ->editColumn('gender', function ($model) {
                $gender = config('custom.genderOptions.' . $model->gender);
                return $gender ?? '';
            })
            ->editColumn('dob', function ($model) {
                $formattedDob = date('M d, Y', strtotime($model->dob));
                return $formattedDob;
            })
            ->editColumn('address', function ($model) {
                return $model->address . ', ' . $model->city ?? '';
            })
            ->editColumn('status', function ($model) {
                if ($model->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } elseif ($model->status == 0) {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->rawColumns(['status','user_name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Student $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model)
    {
        $teacherId = Auth::user()->id;
        $classTeacher = ClassTeacher::where('teacher_id', $teacherId)->first();
        $studentsInClass = collect();

        if ($classTeacher) {
            $class_id = $classTeacher->class_id;
            $studentsInClass = $model->with('user', 'class')
                ->where('class_id', $class_id)
                ->get();
        }

        return $studentsInClass;
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
            'user_name' => ['title' => 'Name',],
            'email_id' => [
                'title' => 'Email ID',
                'data' => 'user.email'
            ],
            'phone' => ['title' => 'Phone'],
            'gender' => ['title' => 'Gender'],
            'blood_group' => ['title' => 'Blood Group'],
            'dob' => ['title' => 'Date of Birth'],
            'address' => ['title' => 'Address'],
            'status' => ['title' => 'Status'],
        ];
        return  $columns;
    }
}
