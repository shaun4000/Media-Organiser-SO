@extends('layouts.main')

@section('title', 'Categories')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
@endif

<div class="container-fluid">
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Categories</h3>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Category Details</p>
        </div>
        <div class="card-body d-flex justify-content-center">
            <form method="post">
                @csrf

                    @foreach ($categories->category as $category)
                    <div class="form-group d-sm-flex input-width">
                    <input class="form-control inputs mb-2" type="text" name="name[{{$category->id}}]" value="{{$category->name}}" >
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-primary ml-sm-2" type="submit" formaction="edit-category/{{$category->id}}">Save</button>
                        <button class="btn btn-danger ml-3" type="submit" formaction="delete-category/{{$category->id}}">Delete</button>
                    </div>
                    </div>
                    <hr />
                    @endforeach

                <hr />

                <div class="d-flex justify-content-center my-2">
                    <button class="btn btn-success btn-sm" type="button" href="#addnew" data-toggle="modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-plus-circle-fill fa-sm text-white-50" style="margin-bottom: 2px;">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
                    </svg>&nbsp;Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add New Category Model -->
<div role="dialog" tabindex="-1" class="modal fade" id="addnew">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add-category') }}">
                    @csrf
                    <div class="row form-group px-4">
                            <label class="control-label" style="position:relative; top:7px;">Category Name:</label>
                            <input type="text" class="form-control" name="name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="add" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
