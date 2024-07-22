<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Метод index теперь находится внутри класса HomeController
    public function index()
    {
        return view('index');
    }
}
