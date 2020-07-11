@extends('layouts.master')
@section('title', 'detail')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">{{$data->judul}}</h5>
        <p class="card-text">
            <a href="/pertanyaan/vote/{{$data->id}}/true" class="badge badge-primary">up vote</a>
            <a href="/pertanyaan/vote/{{$data->id}}/false" class="badge badge-danger">down vote</a>
            Score Vote : {{$voteScore}}
        </p>
    </div>
    <div class="card-body">
        <p class="card-text">{!!$data->isi!!}</p>
        <p class="card-text"><span class="badge badge-info">{{$data->tag}}</span></p>
    </div>
    <div class="card-footer">
        <div>
            <span class="badge badge-light">updated on : {{$data->updated_at->diffForHumans()}}</span>
        </div>
        <div>
            <a class="text text-info" href="{{ url('/jawaban/create/' . $data->id) }}">Jawab </a><a class="text text-success" href="{{$data->id}}/komentar"> komentar</a>
        </div>
    </div>
</div>
<p>
    <a class="text text-primary" data-toggle="collapse" href="#jawaban-tepat" role="button" aria-expanded="false" aria-controls="jawaban-tepat">
        Lihat Jawaban Tepat
    </a>
</p>
<div class="collapse" id="jawaban-tepat">
    <div class="card card-body">
        @if($jawaban_tepat)
            {{ $jawaban_tepat->isi }}
        @else
            {{ 'Belum ada jawaban tepat' }}
        @endif

    </div>
</div>

<br>
<br>
<br>
@foreach($jawaban as $jwbn)
<div class="card border-secondary mb-2">
    <div class="card-header">
        {{ $jwbn->user->name }}
    </div>
    <div class="card-body">
        <p class="card-text">{!! $jwbn->isi !!}</p>
    </div>
    <div class="card-footer">
        <div>
            <a href="{{url('/jawaban/'. $jwbn->id .'/komentar')}}"> komentar</a>
            <a class="text text-warning" href="{{ url('/jawaban/' .$jwbn->id. '/edit') }}">edit</a>
            <form action="{{ url('/jawaban/' . $jwbn->id) }}" method="post" style="display: inline;">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">hapus</button>
            </form>
            <a href="{{ url('/jawaban/upvote/' . $data->id . '/' . $jwbn->id) }}" class="badge badge-primary">up vote</a>
            <a href="{{ url('/jawaban/downvote/' . $data->id . '/' . $jwbn->id) }}" class="badge badge-danger">down vote</a>
            <a class="text text-success" href="{{ url('/pertanyaan/jawaban_tepat/' . $data->id . '/' . $jwbn->id) }}">pilih sebagai jawaban paling tepat</a>
        </div>
    </div>
</div>
@endforeach

@endsection