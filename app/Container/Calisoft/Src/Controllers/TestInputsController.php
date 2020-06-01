<?php

namespace App\Container\Calisoft\Src\Controllers;

use App\Http\Controllers\Controller;
use App\Container\Calisoft\Src\InputTypes;
use Illuminate\Http\Request;


class TestInputsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InputTypes::all();
    }
}
