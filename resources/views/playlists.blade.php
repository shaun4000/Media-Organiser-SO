@extends('layouts.main')

@section('title', 'Playlists')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">All Playlists</h3>
        <a class="btn btn-primary btn-sm d-sm-inline-block mb-1" role="button" href="{{ route('add-playlist') }}"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-plus-circle-fill fa-sm text-white-50" style="margin-bottom: 2px;">
            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
        </svg></i>&nbsp;Add Playlist</a>
    </div>

    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">All Playlists</p>
        </div>
        <div class="card-body">
            @if ($allplaylists->isEmpty())
            <h3 class="text-center">There are no Playlists to display</h3>
            @else
            <p class="text-center">Click on a Playlist to view the songs</p>
            <hr />
            @foreach ($allplaylists as $playlist)
            <a href="/show-playlist?id={{$playlist->id}}"><h1 class="text-center text-dark mb-2 main-headers">{{$playlist->playlist_name}}</h1></a>
            <hr />
            @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
