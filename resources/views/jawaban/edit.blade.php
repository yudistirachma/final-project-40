@extends('layouts.master')

@section('title','Edit Jawaban')

@section('content')


<form action="{{ url('/jawaban/' . $data->id ) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="judul">Isi</label>
        <input name="isi" type="text" class="form-control" id="judul">
    </div>
    <input type="hidden" name="users_id" value="{{ $data->users_id }}">
    <input type="hidden" name="pertanyaan_id" value="{{ $data->pertanyaan_id }}">
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


@endsection