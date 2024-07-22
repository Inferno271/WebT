<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoAlbumController extends Controller
{
    public function index()
    {
        return view('photoalbum');
    }
}


