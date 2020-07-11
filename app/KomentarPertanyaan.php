<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarPertanyaan extends Model
{
    protected $guarded = [];
    protected $table = 'user_comment_pertanyaan';

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan', 'pertanyaan_id');
    }
    public function user()
    {
        return $this->belongsTo('App\user', 'user_id');
    }
}
