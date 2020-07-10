@extends('layouts.master')
@section('title', 'komentar jawaban')
@section('content')
<h2>{{$data[0]->pertanyaan->judul}}</h2>
    @foreach ($data as $d)
        <div class="card mb-4">
            <div class="card-header">
                {{$d->user->name}}
            </div>
            <div class="card-body">
                <p class="card-text">{{$d->isi}}</p>
            </div>
            <div class="card-footer">
                <div>
                <span class="badge badge-light"></span>
                </div>
                <div>
                <a href="">edit</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection