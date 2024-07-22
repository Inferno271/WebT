<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Validators\FormValidation;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function blogEditor()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(config('blog.posts_per_page', 5));
        return view('admin.blog_editor', compact('posts'));
    }

    public function guestbookUpload()
    {
        return view('admin.guestbook_upload');
    }

    public function showUploadForm()
    {
        return view('admin.upload_csv');
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        Log::info('CSV файл успешно загружен');

        $path = $request->file('csv_file')->getRealPath();
        $file = fopen($path, 'r');

        $header = fgetcsv($file, 0, ',');
        Log::info('Заголовок файла CSV: ' . implode(',', $header));

        $expectedHeader = ['title', 'content', 'author', 'created_at'];
        if ($header !== $expectedHeader) {
            Log::error('Файл не соответствует требуемому формату. Ожидалось: ' . implode(',', $expectedHeader) . '. Получено: ' . implode(',', $header));
            return redirect()->route('admin.upload_csv')->with('error', 'Файл не соответствует требуемому формату');
        }

        $validator = new FormValidation();
        $validator->setRule('title', 'isNotEmpty');
        $validator->setRule('content', 'isNotEmpty');
        $validator->setRule('author', 'isNotEmpty');
        $validator->setRule('created_at', 'isNotEmpty');
        $validator->setRule('created_at', 'isDate');

        $pdo = DB::connection()->getPdo();
        $pdo->beginTransaction();

        $query = $pdo->prepare('INSERT INTO blog_posts (title, content, author, created_at) VALUES (:title, :content, :author, :created_at)');

        $rowCount = 0;
        while (($row = fgetcsv($file, 0, ',')) !== false) {
            $data = [
                'title' => $row[0],
                'content' => $row[1],
                'author' => $row[2],
                'created_at' => \Carbon\Carbon::createFromFormat('d.m.Y H:i', $row[3])->format('Y-m-d H:i:s'),
            ];

            Log::info('Обработка строки: ' . json_encode($data));

            $validator->validate($data);

            if ($validator->getErrors()) {
                Log::error('Валидация не удалась: ' . implode(', ', $validator->getErrors()));
                $pdo->rollBack();
                return redirect()->route('admin.upload_csv.form')->with('error', 'Файл содержит ошибки: ' . implode(', ', $validator->getErrors()));
            }

            try {
                $result = $query->execute($data);
                if ($result) {
                    Log::info('Строка успешно вставлена: ' . json_encode($data));
                    $rowCount++;
                } else {
                    Log::error('Не удалось вставить строку: ' . json_encode($data));
                }
            } catch (\Exception $e) {
                Log::error('Ошибка при вставке строки: ' . $e->getMessage() . '. Данные: ' . json_encode($data));
                $pdo->rollBack();
                return redirect()->route('admin.upload_csv')->with('error', 'Ошибка при вставке записи: ' . $e->getMessage());
            }
        }

        $pdo->commit();
        Log::info('Транзакция успешно завершена. Добавлено записей: ' . $rowCount);

        return redirect()->route('admin.upload_csv')->with('success', 'Записи успешно загружены. Добавлено: ' . $rowCount);
    }
}