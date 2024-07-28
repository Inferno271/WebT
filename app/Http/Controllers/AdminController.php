<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\GuestbookEntry;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function blogEditor()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blog_editor', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new BlogPost();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->author = $request->input('author');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('admin.blog_editor')->with('success', 'Запись успешно добавлена');
    }



    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
    
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
    
        $post->delete();
    
        return redirect()->route('admin.blog_editor')->with('success', 'Запись успешно удалена');
    }

    public function guestbookUpload()
    {
        return view('admin.guestbook_upload');
    }

    public function uploadGuestbook(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt,inc'
        ]);

        $file = $request->file('file');
        $content = file_get_contents($file->getRealPath());
        $entries = explode("\n\n", $content);

        foreach ($entries as $entry) {
            $lines = explode("\n", $entry);
            if (count($lines) >= 3) {
                GuestbookEntry::create([
                    'name' => trim($lines[0]),
                    'email' => trim($lines[1]),
                    'message' => trim(implode("\n", array_slice($lines, 2))),
                ]);
            }
        }

        return redirect()->route('admin.guestbook_upload')->with('success', 'Сообщения успешно загружены');
    }


    public function showUploadForm()
    {
        return view('admin.upload_csv');
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $file = fopen($path, 'r');

        $header = fgetcsv($file, 0, ',');
        $expectedHeader = ['title', 'content', 'author', 'created_at'];

        if ($header !== $expectedHeader) {
            return redirect()->route('admin.upload_csv')->with('error', 'Файл не соответствует требуемому формату');
        }

        while (($row = fgetcsv($file, 0, ',')) !== false) {
            BlogPost::create([
                'title' => $row[0],
                'content' => $row[1],
                'author' => $row[2],
                'created_at' => \Carbon\Carbon::createFromFormat('d.m.Y H:i', $row[3]),
            ]);
        }

        fclose($file);

        return redirect()->route('admin.upload_csv')->with('success', 'Записи успешно загружены');
    }


    public function statistics()
    {
        $visitors = Visitor::orderBy('visit_time', 'desc')->paginate(20); // 20 записей на страницу
        return view('admin.statistics', compact('visitors'));
    }

}