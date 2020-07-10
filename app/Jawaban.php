<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $guarded = [];

    public function komentar()
    {
        return $this->hasMany('App\KomentarJawaban');
    }

    public function user()
    {
        return $this->belongsTo('App\User','users_id');
    }

}
