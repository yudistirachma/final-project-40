@extends('layouts.master')

@section('title','Home')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1 class="h3 mb-4 text-gray-800">All Pertanyaan</h1>
        <a href="/pertanyaan/create" class="btn btn-primary mb-4">buat pertanyaan</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">judul</th>
                        <th scope="col">isi</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
        @foreach ($data as $d)        
                    <tr>
                        <td>{{$d->judul}}</td>
                        <td>{!! Str::limit($d->isi, 20) !!}</td>
                        <td>
                            <a href="/pertanyaan/{{$d->id}}" class="btn btn-info">detail</a>
                            <a href="/pertanyaan/{{$d->id}}/edit" class="btn btn-warning">ubah</a>
                            <form action="/pertanyaan/{{$d->id}}" method="post" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">hapus</button>
                            </form>
                        </td>
                    </tr>
        @endforeach
                </tbody>
            </table>
            <div>
                {{$data->links()}}
            </div>
    </div>
</div>

@endsection