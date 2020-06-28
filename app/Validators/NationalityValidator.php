<?php

namespace App\Validators;

use App\Models\Nationality;
use Illuminate\Support\Facades\Validator;

class NationalityValidator
{
    /**
     * @param $data
     * @return array
     */
    public function validate($data)
    {
        $validator = Validator::make($data, Nationality::getRules());
        if ($validator->fails())
        {
            return $validator->errors();
        }
        return [];
    }
}