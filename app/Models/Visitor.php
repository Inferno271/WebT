<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_time',
        'web_page',
        'ip_address',
        'host_name',
        'browser_name',
    ];

    public static function saveStatistic($page)
    {
        self::create([
            'visit_time' => now(),
            'web_page' => $page,
            'ip_address' => request()->ip(),
            'host_name' => gethostbyaddr(request()->ip()),
            'browser_name' => request()->header('User-Agent'),
        ]);
    }
}