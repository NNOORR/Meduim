<?php

namespace App\Validators;

use App\Models\Author;
use Illuminate\Support\Facades\Validator;

class AuthorValidator
{
    /**
     * @param $data
     * @return array
     */
    public function validate($data)
    {
        $validator = Validator::make($data, Author::getRules());
        if ($validator->fails())
        {
            return $validator->errors();
        }
        return [];
    }
}