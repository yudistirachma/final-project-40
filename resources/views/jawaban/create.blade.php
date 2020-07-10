@extends('layouts.master')

@section('title','Beri Jawaban')

@section('content')


<form action="{{ url('/jawaban') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="judul">Isi</label>
        <input name="isi" type="text" class="form-control" id="judul">
    </div>
    <input type="hidden" name="users_id" value="{{ $users_id }}">
    <input type="hidden" name="pertanyaan_id" value="{{ $id }}">
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


@endsection