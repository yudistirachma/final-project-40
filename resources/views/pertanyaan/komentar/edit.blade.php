@extends('layouts.master')
@section('title', 'komentar jawaban')
@section('content')
    {{-- <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">{{$data[0]->pertanyaan->judul}}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{{$data[0]->pertanyaan->isi}}</p>
        </div>
    </div> --}}
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