<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $table = 'user_comment_jawaban';
    protected $guarded = [];


    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban', 'jawaban_id');
    }
    public function user()
    {
        return $this->belongsTo('App\user', 'user_id');
    }
}
