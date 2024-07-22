<?php
namespace App\Models\Validators;
require '../app/Models/Validators/CustomFormValidation.php';

class ResultsVerification extends CustomFormValidation {
    private $result = 0;
    private $answers = [
        'quest1' => '32', // Ответы на вопросы
        'quest2' => '64',
        'quest3' => 'true'
    ];

    public function __construct() {
        parent::__construct();
    }

    public function checkAns($post_array) {
        foreach ($this->answers as $key => $value) {
            if ($post_array[$key] == $value) {
                $this->result++;
            }
        }
    }

    public function getResult() {
        return $this->result;
    }
}