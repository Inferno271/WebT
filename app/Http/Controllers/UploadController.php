<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:inc,txt|max:2048',
        ]);

        if ($request->file('file')->isValid()) {
            $path = $request->file('file')->storeAs('uploads', 'messages.inc');
            return back()->with('success', 'Файл успешно загружен.');
        }

        return back()->with('error', 'Ошибка при загрузке файла.');
    }
}