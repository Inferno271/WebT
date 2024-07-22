<?php

namespace App\Models;

use App\Core\BaseActiveRecord;

class Message extends BaseActiveRecord
{
    protected $table = 'messages';
    
    public $id;
    public $name;
    public $email;
    public $message;
}
