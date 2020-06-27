<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['article_id','path'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * @param array $data
     * @return Attachment
     */
    public static function saveRecord($data,$insert)
    {
        $attachment = null;
        if ($insert)
            $attachment = Attachment::create($data);
        else {
            $attachment = Attachment::where('id', '=', $data['id'])->first();
            $attachment->update($data);
        }
        return $attachment;
    }

}
