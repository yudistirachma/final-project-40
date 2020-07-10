@extends('layouts.master')
@section('title', 'detail')
    
@section('content')
<div class="card">
    <div class="card-header">
    {{$data->judul}}
    </div>
    <div class="card-body">
        <p class="card-text">{{$data->isi}}</p>
        <p class="card-text"><span class="badge badge-info">{{$data->tag}}</span></p>
    </div>
    <div class="card-footer">
        <div>
           <span class="badge badge-light">updated on : {{$data->updated_at->diffForHumans()}}</span>
        </div>
        <div>
        <a href="{{ url('/jawaban/create/' . $data->id) }}">Jawab </a><a href="{{$data->id}}/komentar"> komentar</a>
        </div>
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
        <p class="card-text">{{ $jwbn->isi }}</p>
    </div>
    <div class="card-footer">
        <div>
        <a href="{{url('/jawaban/'. $jwbn->id .'/komentar')}}"> komentar</a>
        <a href="{{ url('/jawaban/' .$jwbn->id. '/edit') }}">edit</a>
            <form action="{{ url('/jawaban/' . $jwbn->id) }}" method="post" style="display: inline;">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">hapus</button>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection