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
    <div class="card-footer"><span class="badge badge-light">updated on : {{$data->updated_at->diffForHumans()}}</span></div>
</div>
@endsection