<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;

class PertanyaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data =  Pertanyaan::all();
        return view('index', compact('data'));
    }
    public function create()
    {
        return view(('pertanyaan.create'));
    }
    public function detail($id)
    {
        $data = Pertanyaan::find($id);
        return view('pertanyaan.detail', compact($data));
    }
    public function edit($id)
    {
        $data = Pertanyaan::find($id);
        return view('pertanyaan.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        Pertanyaan::where('id', $id)->update($request->all());
        return redirect('/pertanyaan/' . $id);
    }
    public function store()
    {
        Pertanyaan::create(request()->all());
        return redirect('/');
    }
    public function destroy($id)
    {
        Pertanyaan::destroy($id);
        return back();
    }
}
