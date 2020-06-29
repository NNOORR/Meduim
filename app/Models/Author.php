<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['name','age', 'nationality_id'];

    /**
     * @return array
     */
    public static function getRules()
    {
        return [
            'name' => 'required',
            'age' => 'required',
            'nationality_id' => 'required',
        ];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function nationality()
    {
       return $this->belongsTo(Nationality::class);
    }

    static function getAuthors(){
        return Author::orderBy('id', 'desc')->paginate(4);
    }

    /**
     * @param array $data
     * @return Author
     */
    public static function saveRecord($data,$insert)
    {
        $author = null;
        if ($insert)
            $author = Author::create($data);
        else {
            $author = Author::where('id', '=', $data['id'])->first();
            $author->update($data);
        }
        return $author;
    }
}
