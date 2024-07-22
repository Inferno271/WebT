<?php

namespace App\Http\Controllers;

use App\Models\Validators\FormValidation;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function submit(Request $request)
    {
        // Создаем экземпляр валидатора
        $validator = new FormValidation();

        // Задаем правила валидации
        $validator->setRule('name', 'isNotEmpty');
        $validator->setRule('gender', 'isNotEmptySelect');
        $validator->setRule('email', 'isNotEmpty');
        $validator->setRule('email', 'isEmail');
        $validator->setRule('phone', 'isNotEmpty');
        $validator->setRule('phone', 'isPhone');
        $validator->setRule('comment', 'isNotEmpty');

        // Выполняем валидацию
        $validator->validate($request->all());

        // Проверяем наличие ошибок валидации
        if (!empty($validator->errors)) {
            // Возвращаем пользователя обратно с ошибками валидации и сохраняем ввод пользователя
            return back()->withErrors($validator->errors)->withInput();
        }

        // Если ошибок нет, перенаправляем пользователя с сообщением об успешной отправке
        return redirect()->route('contacts')->with('success', 'Сообщение успешно отправлено!');
    }
}


