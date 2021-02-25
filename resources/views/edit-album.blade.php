@extends('layouts.main')

@section('title', 'Edit Album')

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
        <h3 class="text-dark mb-0">Edit Album</h3>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Edit Album Details</p>
        </div>
        <div class="card-body d-flex justify-content-center">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="id" value="{{$album->id}}" hidden>
                <div class="form-group input-width">
                    <label class="labels" for="album_name">
                        <strong>Album Name</strong>
                    </label>
                    <input class="form-control inputs" type="text" name="album_name" value="{{$album->album_name}}">
                </div>
                <hr />
                <div class="form-group input-width">
                    <label class="labels" for="artists_id">
                        <strong>Artist</strong>
                    </label>
                    <select class="form-control" name="artists_id">
                        <optgroup label="Choose an Artist">
                            @foreach ($artists as $artist)
                            @if ($album->artists_id == $artist->id)
                            <option value="{{$artist->id}}" selected>{{$artist->artist_name}}</option>
                            @else
                            <option value="{{$artist->id}}">{{$artist->artist_name}}</option>
                            @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <hr />
                <div class="form-group input-width">
                    <label class="labels" for="img">
                        <strong>Album Artwork</strong>
                    </label>
                    @if (!empty($album->img))
                        <div>
                            <img src="/uploads/img/{{$album->img}}" width="150"/>
                            <p>Current Album Cover</p>
                        </div>
                    @else
                        <div>
                            <img src="/uploads/dflt_img/default_album_cover.png" width="150"/>
                            <p>Current Album Cover</p>
                        </div>
                    @endif
                    <input type="file" class="form-control-file mb-2" name="img"/>
                </div>
                <hr />
                <div class="form-group input-width">
                    <label class="labels" for="category">
                        <strong>Category</strong>
                    </label>
                    <select class="form-control" name="category">
                        <optgroup label="Choose a Category">
                            @foreach ($categories as $category)
                            @if ($album->category == $category->name)
                            <option value="{{$category->name}}" selected>{{$category->name}}</option>
                            @else
                            <option value="{{$category->name}}">{{$category->name}}</option>
                            @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <hr />
                <div class="form-group input-width">
                    <label class="labels" for="song1">
                        <strong>Songs</strong>
                    </label>
                    @foreach ($album->songs as $song)
                    <input class="form-control inputs mb-2" type="text" name="song1" value="{{$song->song_name}}" disabled>
                    @endforeach
                </div>
                <hr />
                <div class="form-group input-width">
                    <button class="btn btn-primary btn-sm" type="submit" formaction="{{ route('edit-album-post') }}">Save Album</button>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger btn-sm" type="submit" formaction="{{ route('delete-album') }}">Delete Album</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
