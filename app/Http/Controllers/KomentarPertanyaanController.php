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
    public function edit($id, $komenId)
    {
        $data = KomentarPertanyaan::with(['pertanyaan', 'user'])->where('id', $komenId)->get();
        // dd($data);
        return view('pertanyaan.komentar.edit', compact('data'));
    }
    public function update($id, $komenId)
    {
        // dd($komenId);
        // dd(request()->all());
        $data = request()->all();
        unset($data["_token"], $data["_method"]);
        // dd($data);
        KomentarPertanyaan::where('id', $komenId)->update($data);
        return redirect('/pertanyaan/' . $id . '/komentar');
    }
}
