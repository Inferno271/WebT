<?php
namespace App\Models\Validators;
require '../app/Models/Validators/FormValidation.php';
class CustomFormValidation extends FormValidation {
    public function __construct() {
        $this->setRule('name', 'isNotEmpty');
        $this->setRule('group', 'isNotEmptySelect');
        $this->setRule('quest1', 'isNotEmptySelect'); 
        $this->setRule('quest2', 'isNotEmptySelect');
        $this->setRule('quest3', 'isNotEmptySelect');
    }
}   