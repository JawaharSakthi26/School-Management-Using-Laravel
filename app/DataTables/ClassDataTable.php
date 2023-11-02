<?php

namespace App\DataTables;

use App\Models\AddClass;


class ClassDataTable extends BaseDataTable
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
            ->editColumn('name', function ($model) {
                return $model->name ?? '';
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
                $action = '<a href="' . route('add-class.edit', $id) . '" class="btn btn-sm bg-success-light me-2"> <i class="feather-edit"></i> </a> &nbsp;';
                $action .= '<form action="' . route('add-class.destroy', $id) . '" method="POST">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm bg-danger-light"><i class="feather-trash"></i></button>
                            </form>&nbsp;';
                return $action;
            })
            ->rawColumns(['status', 'action']);
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AddClass $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AddClass $model)
    {
        return $model->get();
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
            'name' => ['title' => 'Subject'],
            'status',
        ];
        return  $columns;
    }
}