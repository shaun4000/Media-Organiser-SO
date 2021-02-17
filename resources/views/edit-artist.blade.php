@extends('layouts.main')

@section('title', 'Edit Artist')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Edit Artist</h3>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Edit Artist Details</p>
        </div>
        <div class="card-body">
            <form method="post">
                @csrf
                <input type="text" name="id" value="{{$artist->id}}" hidden>
                <div class="form-group">
                    <label class="labels" for="artist_name">
                        <strong>Artist Name</strong>
                    </label>
                    <input class="form-control inputs" type="text" name="artist_name" value="{{$artist->artist_name}}">
                </div>
                <div class="form-group">
                    <label class="labels" for="description">
                        <strong>Description</strong>
                    </label>
                    <input class="form-control inputs" type="text" name="description" value="{{$artist->description}}">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" type="submit" formaction="{{ route('edit-artist-post') }}">Save Artist</button>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger btn-sm" type="submit" formaction="{{ route('delete-artist') }}">Delete Artist</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
