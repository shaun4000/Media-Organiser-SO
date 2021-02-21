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
        $validated = $request->validate([
            'artist_name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        ray()->showQueries();
        // Store the artist details as a new artist
        $artist = new Artist;
        $artist->artist_name = $request->artist_name;
        $artist->description = $request->description;
        $artist->save();

        $artist_id = Artist::where('artist_name', $request->artist_name)->pluck('id');
        $arr = array("[","]");
        $id_num = str_replace($arr, "", $artist_id);
        // return redirect()->route('show-artist', ['id' => $artist_id]);
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
        ray()->showQueries();
        // $artist_data = Artist::find($request->id)->first();
        $artist_data = Artist::where('id', $request->id)->first();
        // dd($artist_data);
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
        $artist = Artist::where('id',$request->id)->first();

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
        ray()->showQueries();

        // Updates the project details into the database projects table
        $artist = Artist::where('id',$request->id)->first();
        $artist->artist_name = $request->artist_name;
        $artist->description = $request->description;
        $artist->save();

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
        //
        Artist::destroy($request->id);

        return redirect()->route('home');
    }
}
