<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CrudTrait;

class StudentController extends Controller
{
    use CrudTrait;

    // protected $model = Class::class;
    protected $viewPath = 'admin';
    protected $folderPath = 'student';
    protected $routePrefix = 'add-student';
}
