@extends('layouts.master')
@section('title', 'komentar jawaban')
@section('content')

@if(!$data->first())
<h2>Belum Ada Komentar</h2>
@else

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">{{$data[0]->pertanyaan->judul}}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{!!$data[0]->pertanyaan->isi!!}</p>
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
            <a href="/pertanyaan/komentar/{{$d->id}}" class="card-link">hapus</a>
    @endforeach
        </ul>
    </div>
    @endif
    <form action="/pertanyaan/{{ $id }}/komentar" method="post" class=" mt-4">
        @csrf
        <div class="form-group">
            <label for="komentar">Tambah komentar</label>
            <textarea class="form-control" name="isi" id="komentar" rows="3"></textarea>
        </div>
        <input type="hidden" name="pertanyaan_id" value="{{ $id }}">
        <button type="submit" class="btn btn-primary">kirim</button>
</form>


@endsection