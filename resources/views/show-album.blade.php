@extends('layouts.main')

@section('title', 'Show Album')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center mb-2">
                    @if (!empty($album_data->img))
                    <img width="150" height="150" src="uploads/img/{{$album_data->img}}" style="border-radius: 15px 50px;"/>
                    @else
                    <img width="150" height="150" src="uploads/dflt_img/default_album_cover.png" style="border-radius: 15px 50px;"/>
                    @endif
                </div>
                <h1 class="text-center text-dark mb-2 main-headers">{{$album_data->album_name}}</h1>
                <a href="/show-artist?id={{$album_data->artist->id}}"><h4 class="text-center card-subtitles">{{$album_data->artist->artist_name}}</h4></a>
                <div class="d-flex d-sm-flex justify-content-center align-items-center"><a class="btn btn-primary btn-sm d-sm-inline-block mb-1 mt-4" role="button" href="{{ route('edit-album', $album_data->id) }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Edit Album</a></div>
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
                            <tr onclick="location.href='/show-song?id={{$song->id}}'" style="cursor: pointer;">
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
