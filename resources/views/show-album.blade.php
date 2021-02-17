@extends('layouts.main')

@section('title', 'Show Album')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center text-dark mb-4 main-headers">{{$album_data->album_name}}</h1>
                <div class="d-flex d-sm-flex justify-content-center align-items-center"><a class="btn btn-primary btn-sm d-sm-inline-block mb-1 mt-4" role="button" href="{{ route('edit-album', $album_data->id) }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Edit Album</a></div>
            </div>
        </div>
    </div>
    <div class="text-center mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-titles"><span style="text-decoration: underline;">Artist</span></h3>
                <h4 class="card-subtitles">{{$album_data->artist->artist_name}}</h4>
            </div>
        </div>
    </div>
    <div class="text-center mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-titles"><span style="text-decoration: underline;">Category</span></h3>
                <h4 class="card-subtitles">{{$album_data->category}}</h4>
            </div>
        </div>
    </div>
    <div class="text-center mb-4">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Songs</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($album_data->songs as $song)
                            <tr onclick="location.href='/show-song?id={{$song->id}}'">
                                <td>{{$song->song_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
