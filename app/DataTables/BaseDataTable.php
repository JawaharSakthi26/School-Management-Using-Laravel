<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{
    // protected $excludeFromExport = ['action'];

    public function getActionParamters()
    {
        $params = config('datatables-buttons.action_attributes');

        $params['drawCallback'] = 'function(settings){
            var info = this.api().page.info();
            export_rows_count = info.recordsDisplay;
            export_progress_step = parseFloat(100/export_rows_count) * row_offset;
        }';

        return $params;
    }

    // protected function getBuilderParameters($create_route = null)
    // {
    //     $params = config('datatables-buttons.parameters');

    //     return $params;
    // }
}
