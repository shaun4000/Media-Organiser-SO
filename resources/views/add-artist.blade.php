@extends('layouts.main')

@section('title', 'Add Artist')

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
        <h3 class="text-dark mb-0">Add Artist</h3>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Add Artist Details</p>
        </div>
        <div class="card-body d-flex justify-content-center">
            <form method="POST" action="add-artist">
                @csrf
                <div class="form-group input-width">
                    <label class="labels" for="artist_name">
                        <strong>Artist Name</strong>
                    </label>
                    <input class="form-control inputs" type="text" name="artist_name" required>
                </div>
                <div class="form-group input-width">
                    <label class="labels" for="description">
                        <strong>Description</strong>
                    </label>
                    <input class="form-control inputs" type="text" name="description" required>
                </div>
                <div class="form-group input-width">
                    <button class="btn btn-primary btn-sm" type="submit">Save Artist</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
