@extends('layouts.master')
@section('title', 'komentar jawaban')
@section('content')


@if(!$data->first())
<h2>Belum Ada Komentar</h2>
<a href="{{ url('/jawaban/create_komentar/' . $id) }}">tambah komentar</a>
@else
<h2>{!!$data[0]->jawaban->isi!!}</h2>

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
            <a class="text text-warning" href="{{ url('/jawaban/edit_komentar/' . $data[0]->jawaban->id . '/' . $d->id) }}">edit</a>
            <form action="{{ url('/jawaban/destroy_komentar/' . $d->id) }}" method="post" style="display: inline;">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">hapus</button>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection