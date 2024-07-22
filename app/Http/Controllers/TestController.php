<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TestModel;
use App\Models\Validators\FormValidation;
use App\Models\Validators\ResultsVerification;
use App\Models\TestResult;

class TestController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new TestModel();
    }

    public function index()
    {
        return view('test');
    }

    public function submit(Request $request)
    {
        $validator = new FormValidation();
        $validator->validate($request->all());
        $errors = $validator->getErrors();

        if (!empty($errors)) {
            return view('test')->with('errors', $errors);
        }

        $resultsVerification = new ResultsVerification();
        $resultsVerification->checkAns($request->all());
        $result = $resultsVerification->getResult();

        // Сохранение результатов в базу данных
        TestResult::create([
            'name' => $request->input('name'),
            'group' => $request->input('group'),
            'answers' => $request->only(['quest1', 'quest2', 'quest3']),
            'correct_answers' => $result,
        ]);

        return view('test')->with('result', $result);
    }

    public function showResults()
    {
        $results = TestResult::orderBy('created_at', 'desc')->get();
        return view('test_results', compact('results'));
    }
}
