<?php

namespace App\Core;

use Illuminate\Support\Facades\DB;

class BaseActiveRecord
{
    protected $table; // Название таблицы

    public function save()
    {
        if ($this->id) {
            // Обновление существующей записи
            DB::table($this->table)->where('id', $this->id)->update($this->toArray());
        } else {
            // Создание новой записи
            $this->id = DB::table($this->table)->insertGetId($this->toArray());
        }
        return $this;
    }

    public function delete()
    {
        DB::table($this->table)->where('id', $this->id)->delete();
        return true;
    }

    public static function find($id)
    {
        $instance = new static();
        $result = DB::table($instance->table)->where('id', $id)->first();
        if ($result) {
            foreach ($result as $key => $value) {
                $instance->$key = $value;
            }
        }
        return $instance;
    }

    public static function findAll()
    {
        $instances = [];
        $result = DB::table((new static())->table)->get();
        foreach ($result as $item) {
            $instance = new static();
            foreach ($item as $key => $value) {
                $instance->$key = $value;
            }
            $instances[] = $instance;
        }
        return $instances;
    }

    protected function toArray()
    {
        $attributes = get_object_vars($this);
        unset($attributes['table']);
        return $attributes;
    }
}
