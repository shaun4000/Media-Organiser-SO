<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allsongs = Song::all();

        return view('index', compact('allsongs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::all();

        $categories = array("Rock","Hip Hop","Jazz","Pop","Folk","Blues","Heavy Metal","Musical","Country","Classical","Raggae","Funk","Soul","Punk","Electronic","Disco","World");

        return view('add-album', compact('artists', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validates the album and song details before storing
        // If validation fails the user will be returned to the previous page
        $validated = $request->validate([
            'album_name' => 'required|max:255',
            'category' => 'required|max:255',
            'songs' => 'required|max:255',
        ]);

        // Store the album details as a new album
        $album = new Album;
        $album->artists_id = $request->artists_id;
        $album->album_name = $request->album_name;
        $album->category = $request->category;
        $album->save();

        // Find and store the latest album's id and store into a variable
        $album_id = Album::where('album_name',$request->album_name)->pluck('id');
        $arr = array("[","]");
        $id_num = str_replace($arr, "", $album_id);

        // Loop through the song entries and store them as new songs
        foreach ($request->songs as $song) {
        DB::table('songs')->insert([
            'albums_id' => $id_num,
            'song_name' => $song
        ]);
        }

        //Redirect the user to show the recently stored album
        // return view('show-album', ['id' => $album_id]);
        return redirect()->route('show-album', ['id' => $id_num]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album, Request $request)
    {

        $album_data = Album::where('id', $request->id)->first();

        return view('show-album', compact('album_data'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show_song(Song $song, Request $request)
    {

        $song_data = Song::where('id', $request->id)->first();
        $album_id = $song_data->albums_id;
        $other_songs = Song::where('albums_id', $album_id)->get();

        return view('show-song', compact('song_data', 'other_songs'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album, Request $request)
    {
        // Store the required data into variables to be passed to the edit-album view
        $album = Album::where('id',$request->id)->first();
        $artists = Artist::all();
        $categories = array("Rock","Hip Hop","Jazz","Pop","Folk","Blues","Heavy Metal","Musical","Country","Classical","Raggae","Funk","Soul","Punk","Electronic","Disco","World");

        // Return the edit-album view and push the stored variable information to the view
        return view('edit-album', compact('album', 'artists', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        // Updates the album details into the database albums table
        $album = Album::where('id',$request->id)->first();
        $album->album_name = $request->album_name;
        $album->artists_id = $request->artists_id;
        $album->category = $request->category;
        $album->save();

        // Store the album ID into a variable
        $id = $album->id;

        // Push the album ID to the show-album view
        return redirect()->route('show-album', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album, Request $request)
    {
        // The ID passed to this destroy method will delete the row where the ID matches the ID in the albums table
        Album::destroy($request->id);

        // After the data has been deleted, redirect to the home (index) page
        return redirect()->route('home');
    }
}
