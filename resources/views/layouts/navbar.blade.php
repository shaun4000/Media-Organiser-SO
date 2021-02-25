<nav class="navbar navbar-light navbar-expand-md">
    <div class="container-fluid"><a class="navbar-brand" href="{{ route('home') }}">Media Organiser</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navcol-1">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('playlists') }}">Playlists</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('add-artist') }}">Add Artist</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('add-album') }}">Add Album</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('categories') }}">Categories</a></li>
            </ul>
        </div>
    </div>
</nav>
