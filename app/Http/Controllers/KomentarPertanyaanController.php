<?php

namespace App\Http\Controllers;

use App\KomentarPertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarPertanyaanController extends Controller
{
    public function index($id)
    {
        $data = KomentarPertanyaan::with(['pertanyaan', 'user'])->where('pertanyaan_id', $id)->get();
        return view('pertanyaan.komentar.index', compact('data'));
    }
}
