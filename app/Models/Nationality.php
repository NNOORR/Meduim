<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['name'];

    /**
     * @return array
     */
    public static function getRules()
    {
        return [
            'name' => 'required'
        ];
    }


    static function getNationalities(){
        return Nationality::orderBy('id', 'desc')->paginate(4);
    }

    /**
     * @param array $data
     * @return Nationality
     */
    public static function saveRecord($data,$insert)
    {
        $nationality = null;
        if ($insert)
            $nationality = Nationality::create($data);
        else {
            $nationality = Nationality::where('id', '=', $data['id'])->first();
            $nationality->update($data);
        }
        return $nationality;
    }
}
