@extends('layouts.main')

@section('title', 'Show Song')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center text-dark mb-4 main-headers">{{$song_data->song_name}}</h1>
                <div class="d-flex d-sm-flex justify-content-center align-items-center"></div>
                <div class="d-flex d-sm-flex justify-content-center align-items-center"></div>
            </div>
        </div>
    </div>
    <div class="text-center mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-titles"><span style="text-decoration: underline;">Artist</span></h3>
                <h4 class="card-subtitles">{{$song_data->album->artist->artist_name}}</h4>
                <div class="d-flex d-sm-flex justify-content-center align-items-center"><a class="btn btn-primary btn-sm d-sm-inline-block mb-1 mt-4" role="button" href="/show-artist?id={{$song_data->album->artist->id}}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Show Artist</a></div>
            </div>
        </div>
    </div>
    <div class="text-center mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-titles"><span style="text-decoration: underline;">Album</span></h3>
                <h4 class="card-subtitles">{{$song_data->album->album_name}}</h4>
                <div class="d-flex d-sm-flex justify-content-center align-items-center"><a class="btn btn-primary btn-sm d-sm-inline-block mb-1 mt-4" role="button" href="/show-album?id={{$song_data->albums_id}}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Show Album</a></div>
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
                                <th>All Songs on Album</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($other_songs as $song)
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
