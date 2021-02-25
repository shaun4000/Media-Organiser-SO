@extends('layouts.main')

@section('title', 'Show Playlist')

@section('content')

<div class="text-center mb-4">
    <div class="card">
        <div class="card-body">
            <h3 class="card-titles"><span style="text-decoration: underline;">Playlist</span></h3>
            <h4 class="card-subtitles mb-3">{{$playlist_data->playlist_name}}</h4>
            <div class="d-flex d-sm-flex justify-content-center align-items-center mb-2">
                <a class="btn btn-primary btn-sm d-sm-inline-block mb-1" role="button" href="{{ route('edit-playlist', $playlist_data->id) }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Edit Playlist</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>All Songs in Playlist</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($playlist_data->songs as $song)
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
