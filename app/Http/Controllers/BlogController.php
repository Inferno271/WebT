<?php
namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Validators\FormValidation;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(config('blog.posts_per_page', 5));
        Log::info('Получено записей: ' . $posts->count());
        return view('blog.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'author' => 'required|string|max:255', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $post = new BlogPost();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->author = $request->input('author'); 
        
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('blog_images', 'public');
                $post->image = $imagePath;
                Log::info('Image uploaded: ' . $imagePath);
            } else {
                Log::error('Image upload failed: ' . $request->file('image')->getErrorMessage());
            }
        }

        $post->save();

        return redirect()->route('blog.index')->with('success', 'Запись успешно добавлена');
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Запись успешно удалена');
    }

    public function showUploadForm()
    {
        return view('blog.upload');
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
        return redirect()->route('blog.upload')->with('error', 'Файл не соответствует требуемому формату');
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
            return redirect()->route('blog.upload')->with('error', 'Файл содержит ошибки: ' . implode(', ', $validator->getErrors()));
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
            return redirect()->route('blog.upload')->with('error', 'Ошибка при вставке записи: ' . $e->getMessage());
        }
    }

    $pdo->commit();
    Log::info('Транзакция успешно завершена. Добавлено записей: ' . $rowCount);

    return redirect()->route('blog.index')->with('success', 'Записи успешно загружены. Добавлено: ' . $rowCount);
}
}