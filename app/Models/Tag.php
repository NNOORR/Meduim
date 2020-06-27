<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['article_id','name'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    /**
     * @param array $data
     * @return Tag
     */
    public static function saveRecord($data,$insert)
    {
        $tag = null;
        if ($insert)
            $tag = Tag::create($data);
        else {
            $tag = Tag::where('id', '=', $data['id'])->first();
            $tag->update($data);
        }
        return $tag;
    }
}
