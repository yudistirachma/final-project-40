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
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}
