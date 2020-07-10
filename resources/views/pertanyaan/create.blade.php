@extends('layouts.master')

@section('title','Home')

@section('content')
    <form action="/pertanyaan" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">judul</label>
            <input type="text" name="judul" class="form-control" id="judul" placeholder="">
        </div>
        <div class="form-group">
            <label for="tag">tag</label>
            <input type="text" name="tag" class="form-control" id="tag" placeholder="">
        </div>
        <div class="form-group">
            <label for="isi">isi</label>
            <textarea name="isi" class="form-control" id="isi" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">simpan</button>

    </form>
@endsection