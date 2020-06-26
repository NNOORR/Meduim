<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','brief','description', 'author_id'];

    /**
     * @return array
     */
    public static function getRules()
    {
        return [
            'title' => 'required',
            'brief' => 'required',
            'description' => 'required',
            'author_id' => 'required',
        ];
    }

    static function getArticles(){
        return Article::all()->sortDesc();
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }


    /**
     * @param array $data
     * @return Location
     */
    public static function saveRecord($data,$insert)
    {
            $article = null;
            if ($insert)
                $article = Article::create($data);
            else {
                $article = Article::where('id', '=', $data['id'])->first();
                $article->update($data);
            }
            return $article;
    }

}
