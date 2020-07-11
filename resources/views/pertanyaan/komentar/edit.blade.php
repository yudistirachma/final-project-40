@extends('layouts.master')
@section('title', 'komentar jawaban')
@section('content')
    <form action="/pertanyaan/{{$data[0]->pertanyaan->id}}/komentar/{{$data[0]->id}}" method="post" class=" mt-4">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="komentar">edit komentar by: {{$data[0]->user->name}} </label>
            <textarea class="form-control" name="isi" id="komentar" rows="3">{{$data[0]->isi}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">kirim</button>
    </form>
@endsection