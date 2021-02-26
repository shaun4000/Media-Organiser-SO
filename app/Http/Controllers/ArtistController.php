<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the add-artist view
        return view('add-artist');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If validation fails the user will be returned to the previous page
        $validated = $request->validate([
            'artist_name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        // Store the artist details as a new artist
        $artist = new Artist;
        $artist->artist_name = $request->artist_name;
        $artist->description = $request->description;
        $artist->save();

        // Get the id of the currently made album to pass to the route
        $artist_id = Artist::where('artist_name', $request->artist_name)->pluck('id');
        $arr = array("[","]");
        $id_num = str_replace($arr, "", $artist_id);

        // Redirect to the show-artist route with the currently made artist's id
        return redirect()->route('show-artist', ['id' => $id_num]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist, Request $request)
    {
        // Get the artists details where ID equals the id passed from the view
        $artist_data = Artist::where('id', $request->id)->first();

        // Pass the artist details to the show-artist view
        return view('show-artist', compact('artist_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist, Request $request)
    {
        // Get the artist details where ID equals the id passed from the view
        $artist = Artist::where('id',$request->id)->first();

        // Pass the artist details to the edit-artist view
        return view('edit-artist', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        // If validation fails the user will be returned to the previous page
        $validated = $request->validate([
            'artist_name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        // Updates the project details into the database projects table
        $artist = Artist::where('id',$request->id)->first();
        $artist->artist_name = $request->artist_name;
        $artist->description = $request->description;
        $artist->save();

        // Get the artists id
        $id = $artist->id;

        // Push the project details to the show-project view
        return redirect()->route('show-artist', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist, Request $request)
    {
        // Delete the artist where ID equals the id passed from the view
        Artist::destroy($request->id);

        // Open the index view via the home route
        return redirect()->route('home');
    }
}
