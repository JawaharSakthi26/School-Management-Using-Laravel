<?php

namespace App\DataTables;


use App\Models\ClassTeacher;


class ClassTeacherDataTable extends BaseDataTable
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
            ->editColumn('Class Name', function ($model) {
                return $model->class_id ?? '';
            })
            ->editColumn('Teacher Name', function ($model) {
                return $model->teacher_id ?? '';
            })
            ->editColumn('assigned_by', function ($model) {
                $userName = $model->user->name ?? '';
                return '<span class="badge badge-info">' . $userName . '</span>';
            })
            ->addColumn('action', function ($model) {
                $id = $model->id;
                $action = '<a href="' . route('add-classTeacher.edit', $id) . '" class="btn btn-sm bg-success-light me-2"> <i class="feather-edit"></i> </a> &nbsp;';
                $action .= '<form action="' . route('add-classTeacher.destroy', $id) . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm bg-danger-light"><i class="feather-trash"></i></button>
                            </form>&nbsp;';
                return $action;
            })
            ->rawColumns(['status', 'action','assigned_by']);
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ClassTeacher $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ClassTeacher $model)
    {
        return $model->with('class','teacher', 'user')->get();
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
        $columns = [
            'index' => ['title' => '#', 'data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
            'class_id' => [
                'title' => 'Class Name',
                'data' => 'class.name',
            ],
            'teacher_id' => [
                'title' => 'Teacher Name',
                'data' => 'teacher.name',
            ],
            'assigned_by' => ['title' => 'Assigned By',],
        ];
        return  $columns;
    }
}