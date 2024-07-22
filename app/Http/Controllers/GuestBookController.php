<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestBookController extends Controller
{
    public function index()
    {
        $messages = $this->getMessagesFromFile();
        return view('guestbook.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $fullName = $validated['surname'] . ' ' . $validated['name'] . ' ' . $validated['patronymic'];
        $date = date('d.m.y');

        $messageString = implode(';', [
            $date,
            $fullName,
            $validated['email'],
            $validated['message']
        ]) . "\n";

        Storage::append('messages.inc', $messageString);

        return redirect()->route('guestbook.index')->with('success', 'Сообщение успешно добавлено!');
    }

    private function getMessagesFromFile()
    {
        
        if (!Storage::exists('uploads/messages.inc')) {
            return [];
        }
        $content = Storage::get('uploads/messages.inc');
        $lines = explode("\n", trim($content));
        $messages = [];

        foreach ($lines as $line) {
            $parts = explode(';', $line);
            if (count($parts) === 4) {
                $messages[] = [
                    'date' => $parts[0],
                    'fullName' => $parts[1],
                    'email' => $parts[2],
                    'message' => $parts[3],
                ];
            }
        }

        // Сортировка сообщений по дате в порядке убывания
        usort($messages, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return $messages;
    }
}