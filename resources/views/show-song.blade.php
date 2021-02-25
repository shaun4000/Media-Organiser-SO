@extends('layouts.main')

@section('title', 'Show Song')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <div class="d-flex justify-content-center">
            <div class="card clean-card text-center" style="border-radius: 25px;max-width: 400px;">
                @if (!empty($song_data->album->img))
                <img class="card-img-top w-100 d-block" src="uploads/img/{{$song_data->album->img}}" style="border-top-left-radius: 25px;border-top-right-radius: 25px;" />
                @else
                <img class="card-img-top w-100 d-block" src="uploads/dflt_img/default_album_cover.png" style="border-top-left-radius: 25px;border-top-right-radius: 25px;" />
                @endif
                <div class="card-body info">
                    <a href="/show-artist?id={{$song_data->album->artist->id}}"><h4 class="card-subtitles">{{$song_data->album->artist->artist_name}}</h4></a>
                    <h1 class="text-center text-dark mb-4 main-headers">{{$song_data->song_name}}</h1>
                    <div class="d-flex d-sm-flex justify-content-center align-items-center">
                        <audio controls style="box-shadow: 5px 5px 20px rgba(0,0, 0, 0.4);border-radius: 90px;transform: scale(1.05);width: 100%;">
                    <source src="/uploads/songs/{{$song_data->file_name}}" type="audio/mpeg">
                        Your browser does not support the audio element
                        </audio>
                    </div>
                </div>
                <div class="d-flex d-sm-flex justify-content-center align-items-center mt-2 mb-4">
                    <a class="btn btn-primary btn-sm d-sm-inline-block" role="button" href="#song-details" data-toggle="modal">Show Song Details</a>
                </div>
            </div>
        </div>
    </div>



    <div class="text-center mb-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-titles"><span style="text-decoration: underline;">Album</span></h3>
                <a href="/show-album?id={{$song_data->albums_id}}"><h4 class="card-subtitles">{{$song_data->album->album_name}}</h4></a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>All Songs on Album</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($other_songs as $song)
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

<div role="dialog" tabindex="-1" class="modal fade" id="song-details"">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Song Details</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>Song Name: {{$song_data->song_name}}</p>
                <p>Ablum Name: {{$song_data->album->album_name}}</p>
                <p>Artist Name: {{$song_data->album->artist->artist_name}}</p>
                <p>Date Uploaded: {{$song_data->album->created_at}}</p>
                <p>File Type: {{$song_data->file_type}}</p>
                <p>File Size: {{$song_data->file_size}}</p>
                <p>File Location: {{$song_data->file_location}}</p>
                <form method="POST" action="edit-comment/{{$song_data->id}}">
                    @csrf
                    <div class="form-group">
                            <label class="control-label" style="position:relative; top:7px;">Comments:</label>
                            <input type="text" class="form-control" name="comment" value="{{$song_data->comment}}">
                    </div>
                        <button type="submit" name="add" class="btn btn-primary">Save Comment</button>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
@endsection
