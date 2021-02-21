@extends('layouts.main')

@section('title', 'Add Album')

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
        <h3 class="text-dark mb-0">Add Album</h3>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Add Album Details</p>
        </div>
        <div class="card-body">
            @if ($artists->isEmpty())
            <h3 class="text-center">No Artists available, create an Artist first</h3>
            <div class="d-flex d-sm-flex justify-content-center align-items-center mt-4"><a class="btn btn-primary btn-sm d-sm-inline-block mb-1" role="button" href="{{ route('add-artist') }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Add Artist</a></div>
            @else
            <form method="POST" action="add-album" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="labels" for="album_name">
                        <strong>Album Name</strong>
                    </label>
                    <input class="form-control inputs" type="text" name="album_name">
                </div>
                <div class="form-group">
                    <label class="labels" for="artists_id">
                        <strong>Artist</strong>
                    </label>
                    <select class="form-control" name="artists_id">
                        <optgroup label="Choose an Artist">
                            @foreach ($artists as $artist)
                            <option value="{{$artist->id}}">{{$artist->artist_name}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="form-group"><label class="labels" for="category"><strong>Category</strong></label><select class="form-control" name="category">
                        <optgroup label="Choose a Category">
                            @foreach ($categories as $category)
                            <option value="{{$category}}">{{$category}}</option>
                            @endforeach
                        </optgroup>
                    </select></div>
                <div class="form-group" id="song-group">
                    <label class="labels" for="songs[1]">
                        <strong>Songs</strong>
                    </label>
                    <input class="form-control mb-2" type="text" name="songs[1]">
                    <input type="file" class="form-control-file mb-2" name="file[1]"/>
                </div>
                <div class="d-flex justify-content-center my-2"><button class="btn btn-success btn-sm" type="button" onclick="add_fields();"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-plus-circle-fill fa-sm text-white-50" style="margin-bottom: 2px;">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                        </svg>&nbsp;Add Song</button></div>
                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Album</button></div>
            </form>
            @endif
        </div>
    </div>
</div>

@endsection
