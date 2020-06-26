<?php

namespace App\Validators;

use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleValidator
{
    /**
     * @param $data
     * @return array
     */
    public function validate($data)
    {
        $validator = Validator::make($data, Article::getRules());
        if ($validator->fails())
        {
            return $validator->errors();
        }
        return [];
    }
}