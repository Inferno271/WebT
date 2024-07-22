<?php
namespace App\Models\Validators;

class FormValidation {
    public $errors = [];
    public $rules = [
        'ФИО' => [
            'isNotEmpty'
        ],
        'Группа' => [
            'isNotEmpty'
        ],
        'Телефон' => [
            'isNotEmpty',
            'isPhone'
        ],
        'Дата' => [
            'isNotEmpty'
        ],
        'Email' => [
            'isEmail'   
        ],
        'title' => [
            'isNotEmpty'
        ],
        'content' => [
            'isNotEmpty'
        ],
        'created_at' => [
            'isDate'
        ]
    ];

    public function setRule($field_name, $validator_name) {
        $this->rules[$field_name] = [$validator_name];
    }

    public function getErrors() {
        return $this->errors;
    }

    public function validate($post_array) {
        foreach ($post_array as $key => $item) {
            if ($key !== '_token' && isset($this->rules[$key])) {
                foreach ($this->rules[$key] as $rule) {
                    $this->$rule($item, $key);
                }
            }
        }
    }

    public function isNotEmpty($data, $key) {
        if (empty($data)) {
            array_push($this->errors, "Поле $key не должно быть пустым");
        }
        return true;
    }

    public function isInteger($data, $key = null, $value = null) {
        if (ctype_digit($data)) {
            array_push($this->errors, "Поле $key содержит числа");
        }
        return false;
    }

    public function isLess($data, $key, $value = null){
        if ($this->isInteger($data) && ((int)$this->isInteger($data) >= $value)) {
            array_push($this->errors, "Поле $key слишком длинное");
        }
        return true;
    }

    public function isGreater($data, $key, $value = null){
        if ($this->isInteger($data) && ((int)$this->isInteger($data) <= $value)) {
            array_push($this->errors, "Поле $key слишком короткое");
        }
        return true;
    }

    public function isEmail($data, $key, $value = null) {
        if (preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $data)) {
            return true;
        }
        array_push($this->errors, "В поле $key неверно введена почта");
    }

    public function isPhone($data, $key, $value = null) {
        if (preg_match('/^(\+7)([0-9]{8,10})$/', $data)) {
            return true;
        }
        array_push($this->errors, "В поле $key неверно введен номер телефона");
    }

    public function isDate($data, $key, $format = 'Y-m-d H:i:s')
    {
        $date = \DateTime::createFromFormat($format, $data);
        if ($date && $date->format($format) === $data) {
            return true;
        }
        array_push($this->errors, "Поле $key содержит недопустимую дату");
        return false;
    }
}
