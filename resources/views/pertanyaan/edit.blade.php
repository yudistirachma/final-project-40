@extends('layouts.master')

@section('title','Edit')

@section('content')
    <form action="/pertanyaan/{{$data->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="judul">judul</label>
            <input type="text" value="{{$data->judul}}" name="judul" class="form-control" id="judul" placeholder="">
        </div>
        <div class="form-group">
            <label for="tag">tag</label>
            <input type="text" value="{{$data->tag}}" name="tag" class="form-control" id="tag" placeholder="">
        </div>
        <div class="form-group">
            <label for="isi">isi</label>
            <textarea name="isi" class="form-control" id="isi" rows="3">{{$data->isi}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">simpan</button>

    </form>
@endsection