<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    //
    protected $table = 'pertanyaan';
    protected $guarded = [];

    public function komentaPertanyaan()
    {
        return $this->hasMany('App\KomentarPertanyaan', 'pertanyaan_id');
    }
}
