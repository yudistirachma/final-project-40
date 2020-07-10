@extends('layouts.master')

@section('title','Beri Komentar')

@section('content')


<form action="{{ url('/jawaban/store_komentar') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="judul">Isi</label>
        <input name="isi" type="text" class="form-control" id="judul">
    </div>
    <input type="hidden" name="user_id" value="{{ $users_id }}">
    <input type="hidden" name="jawaban_id" value="{{ $data->id }}">
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


@endsection