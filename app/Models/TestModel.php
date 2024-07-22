<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validators\ResultsVerification;

class TestModel extends Model {
    protected $validator;

    public function __construct() {
        parent::__construct();
        $this->validator = new ResultsVerification();
    }

    public function setValidator($validator) {
        $this->validator = $validator;
    }
}
