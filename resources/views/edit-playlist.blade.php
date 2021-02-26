@extends('layouts.main')

@section('title', 'Edit Playlist')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Edit Playlist</h3>
    </div>
    <div class="mb-4">
        <div class="card">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Edit Playlist Details</p>
            </div>
            <div class="card-body d-flex justify-content-center">
                <form method="POST">
                    @csrf
                <input type="text" name="id" value="{{$playlist->id}}" hidden>
                    <div class="form-group input-width">
                        <label class="labels" for="playlist_name">
                            <strong>Playlist Name</strong><br />
                        </label>
                        <input type="text" class="form-control inputs" name="playlist_name" value="{{$playlist->playlist_name}}" required/>
                    </div>
                    <div class="table-responsive input-width">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Select Songs</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allsongs as $song)
                                <tr>
                                    <td>{{$song->song_name}}</td>
                                    @if (str_contains($song->playlists, ':'))
                                    <td>
                                        <div class="d-flex justify-content-center custom-control custom-switch">
                                            <input type="checkbox" id="customSwitch{{ $loop->iteration }}" class="custom-control-input" name="playlists[{{ $loop->iteration }}]" value="{{$song->id}}" checked/>
                                            <label class="custom-control-label" for="customSwitch{{ $loop->iteration }}"></label>
                                        </div>
                                    </td>
                                    @else
                                    <td>
                                        <div class="d-flex justify-content-center custom-control custom-switch">
                                            <input type="checkbox" id="customSwitch{{ $loop->iteration }}" class="custom-control-input" name="playlists[{{ $loop->iteration }}]" value="{{$song->id}}" />
                                            <label class="custom-control-label" for="customSwitch{{ $loop->iteration }}"></label>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group input-width">
                        <button class="btn btn-primary btn-sm" type="submit" formaction="{{ route('edit-playlist-post') }}">Save Playlist</button>
                    </div>
                    <div class="form-group input-width">
                        <button class="btn btn-danger btn-sm" type="submit" formaction="{{ route('delete-playlist') }}">Delete Playlist</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
