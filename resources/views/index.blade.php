@extends('layouts.main')

@section('title', 'Home')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
@endif

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">All Songs</h3>
        <div class="d-flex justify-content-center">
            <form action="{{ route('db-backup') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary mx-2">Save Data</button>
            </form>
            <form action="{{ route('db-upload') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-primary mx-2">Load Data</button>
            </form>
                <button class="btn btn-danger mx-2" type="button" href="#clean_db" data-toggle="modal">Clean Media Organiser</button>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">All Songs</p>
        </div>
        <div class="card-body">
            @if ($allsongs->isEmpty())
            <h3 class="text-center">There are no songs to display</h3>
            <div class="d-flex d-sm-flex justify-content-center align-items-center mt-4"><a class="btn btn-primary btn-sm d-sm-inline-block mb-1" role="button" href="{{ route('add-artist') }}"><i class="fas fa-edit fa-sm text-white-50"></i>&nbsp;Add an Artist to Create Songs</a></div>
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
                        <tr onclick="location.href='/show-song?id={{$song->id}}'" style="cursor: pointer;">
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

<!-- Add Clean DB Model -->
<div role="dialog" tabindex="-1" class="modal fade" id="clean_db">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ARE YOU SURE?</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>This will delete all songs and images from the local system and clean the Database</p>
                <form action="{{ route('db-clean') }}" method="get">
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="add" class="btn btn-danger">I'm Sure</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/datatable.js"></script>
@endsection
