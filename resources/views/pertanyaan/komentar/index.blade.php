@extends('layouts.master')
@section('title', 'komentar jawaban')
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">{{$data[0]->pertanyaan->judul}}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{{$data[0]->pertanyaan->isi}}</p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="crad-text">komentar</p>
        </div>   
        <ul class="list-group list-group-flush"> 
    @foreach ($data as $d)
            <li class="list-group-item">
                <span class="badge badge-pill badge-light">{{$d->user->name}}</span>
                <p class="crad-text">{{$d->isi}}</p>
            <a href="/pertanyaan/{{$d->pertanyaan->id}}/komentar/edit/{{$d->id}}" class="card-link">Edit</a>
    @endforeach
        </ul>
    </div>
    <form action="/pertanyaan/{{$data[0]->pertanyaan->id}}/komentar" method="post" class=" mt-4">
        @csrf
        <div class="form-group">
            <label for="komentar">komentar</label>
            <textarea class="form-control" name="isi" id="komentar" rows="3"></textarea>
        </div>
        <input type="hidden" name="pertanyaan_id" value="{{$data[0]->pertanyaan->id}}">
        <button type="submit" class="btn btn-primary">kirim</button>
</form>
@endsection