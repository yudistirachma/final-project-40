@extends('layouts.master')

@section('title','Beri Jawaban')

@section('content')


<form action="{{ url('/jawaban') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="judul">Isi</label>
        <input name="isi" type="text" class="form-control" id="judul">
    </div>
    <input type="hidden" name="users_id" value="1">
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


@endsection