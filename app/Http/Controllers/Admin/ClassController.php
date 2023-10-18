<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CrudTrait;
use App\Models\AddClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    use CrudTrait;
    
    protected $model = AddClass::class;
    protected $viewPath = 'admin';
    protected $folderPath = 'class';
    protected $routePrefix = 'add-class';
}
