<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Select all playlists
        $allplaylists = Playlist::all();

        // Return the playlists view along with the playlists
        return view('playlists', compact('allplaylists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Select all songs
        $allsongs = Song::all();

        // Return the add-playlist view along with the songs
        return view('add-playlist', compact('allsongs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Store the playlist details into the database playlists table
        $newPlaylist = new Playlist;
        $newPlaylist->playlist_name = $request->playlist_name;
        $newPlaylist->save();

        // Store the latest playlist entries id into a variable
        $playlistId = Playlist::latest('id')->first();

        // If there are playlist values, loop through each playlist value entry and store into the playlists_songs table
        if (!empty($request->playlists)) {
            foreach ($request->playlists as $playlist) {
                DB::table('playlists_songs')->insert([
                    'playlists_id' => $playlistId->id,
                    'songs_id' => $playlist
                ]);
            }
        }


        // Redirect back to the playlists route
        return redirect()->route('playlists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Select the playlist where id equals the playlist id passed from the view
        $playlist_data = Playlist::where('id', $request->id)->first();

        // Return the show-playlist view with the playlist information
        return view('show-playlist', compact('playlist_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // Select the playlist where id equals the playlist id passed from the view
        $playlist = Playlist::where('id',$request->id)->first();

        // Select all songs
        $allsongs = Song::all();

        // Return the edit-playlist view along with the playlist information and the songs
        return view('edit-playlist', compact('playlist', 'allsongs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // Updates the playlist details into the database playlists table
        $updatePlaylist = Playlist::where('id',$request->id)->first();
        $updatePlaylist->playlist_name = $request->playlist_name;
        $updatePlaylist->save();

        // Store the playlist id into a variable
        $playlistId = $request->id;

        // Select only the song IDs
        $allsongs = Song::all()->pluck('id');

        // First we need to check if the playlist array passed from the view is empty or not
        if (empty($request->playlists)) { // The playlist array is empty

            // Delete all table rows where the playlist ID passed from the view equals playlists_id in the table
            DB::table('playlists_songs')->where('playlists_id', $playlistId)->delete();

        } else { // The playlist array is not empty

            // Now knowing the array is not empty, we must loop through the playlist values passed from the view
            // and check whether they need to be inserted into the playlists_songs table, left in there or deleted out of it.
            foreach ($request->playlists as $playlist) { //Loop through the playlist values

                foreach ($allsongs as $song) { // Loop through the song IDs

                    // Check whether an entry already exists from the playlist values passed from the view and put a boolean value into a variable
                    $check_playlist = DB::table('playlists_songs')->where('songs_id',$playlist)->exists();

                    // Now we need to check if the song ID matches the playlist value passed from the view.
                    // If it does and it doesn't exist then insert a new entry, if it does exist then move on to the need iteration.
                    // If the song ID and the playlist value doesn't match and the entry does exist then delete that entry from the playlists_songs table.
                    if ($song == $playlist) { // The song ID and playlist value do match (So we DO want this entry in the playlists_songs table)
                        // Check if the entry exists
                        if (!$check_playlist) { // The entry does not exist
                            // Insert a new entry into the playlists_songs table
                            DB::table('playlists_songs')->insert([
                                'playlists_id' => $playlistId,
                                'songs_id' => $playlist
                            ]);
                        }

                    } else { // The song ID and playlist value do not match (So we DO NOT want this entry in the playlists_songs table)

                        // Check if the entry exists
                        if ($check_playlist) { // The entry does exist

                            // Delete the entry from the playlists_songs table
                            DB::table('playlists_songs')->where('songs_id', $song)->delete();
                        }

                    }
                }
            }
        }

        // Store the playlist id into a variable named id to 'show' which needs a value named id to function
        $id = $request->id;

        // Redirect to the show-playlist route passing a value named id
        return redirect()->route('show-playlist', compact('id'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // The ID passed to this destroy method will delete the row where the ID matches the ID in the albums table
        Playlist::destroy($request->id);

        // After the data has been deleted, redirect to the home (index) page
        return redirect()->route('playlists');
    }


}
