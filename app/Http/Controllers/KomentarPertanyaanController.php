<?php

namespace App\Http\Controllers;

use App\KomentarPertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarPertanyaanController extends Controller
{
    public function index($id)
    {
        $user = Auth::user()->id;
        $data = KomentarPertanyaan::with(['pertanyaan', 'user'])->where('pertanyaan_id', $id)->get();
        return view('pertanyaan.komentar.index', compact('data', 'user'));
    }
    public function store()
    {
        $data = request()->all();
        $data["user_id"] = Auth::user()->id;
        unset($data["_token"]);
        // dd($data);
        KomentarPertanyaan::create($data);
        return back();
    }
    public function destroy($komenId)
    {
        KomentarPertanyaan::destroy($komenId);
        return back();
    }
}
