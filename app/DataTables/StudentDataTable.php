<?php

namespace App\DataTables;


use App\Models\Student;

class StudentDataTable extends BaseDataTable
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
            ->editColumn('email_id', function ($model) {
                return $model->user_id ?? '';
            })
            ->editColumn('class_name', function ($model) {
                return $model->class_id ?? '';
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
            ->addColumn('action', function ($model) {
                $id = $model->id;
                $action = '<a href="' . route('add-student.edit', $model->user_id) . '" class="btn btn-sm bg-success-light me-2"> <i class="feather-edit"></i> </a> &nbsp;';
                $action .= '<form action="' . route('add-student.destroy', $model->user_id) . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm bg-danger-light"><i class="feather-trash"></i></button>
                            </form>&nbsp;';
                return $action;
            })
            ->rawColumns(['status', 'action', 'user_name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Student $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model)
    {
        return $model->with('user', 'class')->get();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        // $params = $this->getBuilderParameters();
        $params['scrollX'] = true;
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
        $columns = [
            'index' => ['title' => '#', 'data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
            'user_name' => ['title' => 'Name',],
            'email_id' => [
                'title' => 'Email ID',
                'data' => 'user.email'
            ],
            'class_name' => [
                'title' => 'Class',
                'data' => 'class.name'
            ],
            'phone' => ['title' => 'Phone'],
            'gender' => ['title' => 'Gender'],
            'dob' => ['title' => 'Date of Birth'],
            'address' => ['title' => 'Address'],
            'status' => ['title' => 'Status'],
        ];
        return  $columns;
    }
}
