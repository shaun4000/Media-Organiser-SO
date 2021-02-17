@extends('layouts.main')

@section('title', 'Show Artist')

@section('content')

<div class="container-fluid">
    <div class="mb-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center text-dark mb-4 main-headers">{{$artist_data->artist_name}}</h1>
                <p class="text-center">{{$artist_data->description}}</p>
                <div class="d-flex d-sm-flex justify-content-center align-items-center">
                    <a class="btn btn-primary btn-sm d-sm-inline-block mb-1 mt-4" role="button" href="{{ route('edit-artist', $artist_data->id) }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Edit Artist</a>
                </div>
                <div class="d-flex d-sm-flex justify-content-center align-items-center">
                    <a class="btn btn-primary btn-sm d-sm-inline-block mb-1 mt-3" role="button" href="{{ route('add-album') }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Add Album</a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mb-4">
        <div class="card">
            <div class="card-body">
                @if ($artist_data->albums->isEmpty())
                <h3 class="text-center">There are no Albums to display</h3>
                @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Albums</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($artist_data->albums as $album)
                            <tr onclick="location.href='/show-album?id={{$album->id}}'">
                                <td>{{$album->album_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
