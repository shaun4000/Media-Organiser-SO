@extends('layouts.main')

@section('title', 'Home')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">All Songs</h3>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">All Songs</p>
        </div>
        <div class="card-body">
            @if ($allsongs->isEmpty())
            <h3 class="text-center">There are no songs to display</h3>
            @else
            <p class="text-center">Click on a song in the table to view the song and it's details</p>
            <div class="table-responsive">
                <table class="table my-0 table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Song</th>
                            <th>Album</th>
                            <th>Artist</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allsongs as $song)
                        <tr onclick="location.href='/show-song?id={{$song->id}}'">
                            <td>{{$song->song_name}}</td>
                            <td>{{$song->album->album_name}}</td>
                            <td>{{$song->album->artist->artist_name}}</td>
                            <td>{{$song->album->category}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Song</strong></td>
                            <td><strong>Album</strong></td>
                            <td><strong>Artist</strong></td>
                            <td><strong>Category</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
@endsection
