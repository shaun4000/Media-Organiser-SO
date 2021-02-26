<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\VarDumper\VarDumper;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Schema::hasTable('artists')) {
            return view('run-migrations');
        }

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

        // Store the category values from the categories.xml file
        $xmlString = file_get_contents(public_path('categories.xml'));
        $categories = simplexml_load_string($xmlString);


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

        // If an image was posted from the view then rename the image and upload it to the public folder.
        // Else give the image name a null value.
        if (!empty($request->img)) {
            $extension = $request->img->extension();
            $imgName = time().'_'.$request->album_name.'.'.$extension;
            $request->img->move(public_path('uploads/img'), $imgName);
        } else {
            $imgName = "";
        }

        // Store the album details as a new album
        $album = new Album;
        $album->artists_id = $request->artists_id;
        $album->album_name = $request->album_name;
        $album->category = $request->category;
        $album->img = $imgName;
        $album->save();

        // $imgName = time().'_'.$request->album_name;
        // $request->img->move(public_path('uploads/img'), $imgName);

        // Find and store the latest album's id and store into a variable
        $album_id = Album::where('album_name',$request->album_name)->pluck('id');
        $arr = array("[","]");
        $id_num = str_replace($arr, "", $album_id);
        // $files = $request->file('files');
        // Loop through the song entries and store them as new songs
        $addNum = 1;
        $location = "/public/uploads/songs";

        foreach ($request->songs as $song) {
        $extension = $request->file[$addNum]->extension();
        $f_name = $request->file[$addNum]->getClientOriginalName();
        $fileName = time().'_'.$f_name;
        $size = $request->file[$addNum]->getSize();
        $request->file[$addNum]->move(public_path('uploads/songs'), $fileName);

        if ($size >= 1073741824)
        {
            $size = number_format($size / 1073741824, 2) . ' GB';
        }
        elseif ($size >= 1048576)
        {
            $size = number_format($size / 1048576, 2) . ' MB';
        }
        elseif ($size >= 1024)
        {
            $size = number_format($size / 1024, 2) . ' KB';
        }
        elseif ($size > 1)
        {
            $size = $size . ' bytes';
        }
        elseif ($size == 1)
        {
            $size = $size . ' byte';
        }
        else
        {
            $size = '0 bytes';
        }

        DB::table('songs')->insert([
            'albums_id' => $id_num,
            'song_name' => $song,
            'file_name' => $fileName,
            'file_type' => $extension,
            'file_size' => $size,
            'file_location' => $location,
            'comment' => $request->comments[$addNum]
        ]);
        $addNum++;
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

        // Store the category values from the categories.xml file
        $xmlString = file_get_contents(public_path('categories.xml'));
        $categories = simplexml_load_string($xmlString);

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
        // Select the album where id equals the id passed from the view
        $album_current = Album::where('id', $request->id)->first();


        // If an image has been posted from the view then delete the old image, rename the new image and upload it to the public folder.
        if (!empty($request->img)) {
            // Store the extension of the image into a variable
            $extension = $request->img->extension();

            // Store the album name and extension into a variable prefixed with a time
            $imgName = time().'_'.$request->album_name.'.'.$extension;

            // Delete the old image
            File::delete('uploads/img/'.$album_current->img);


            // Store the image into the public folder
            $request->img->move(public_path('uploads/img'), $imgName);

        }


        // Updates the album details into the database albums table
        $album = Album::where('id',$request->id)->first();
        $album->album_name = $request->album_name;
        $album->artists_id = $request->artists_id;
        $album->category = $request->category;
        if (!empty($request->img)) {
            $album->img = $imgName;
        }
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
        // Select the album where id equals the id passed from the view
        $album = Album::where('id', $request->id)->first();

        // Delete the image associated with the album in the public folder
        File::delete('uploads/img/'.$album->img);

        // Delete each song in the public folder associated with the album
        foreach ($album->songs as $song) {
            File::delete('uploads/songs/'.$song->file_name);
        }

        // The ID passed to this destroy method will delete the row where the ID matches the ID in the albums table
        Album::destroy($request->id);

        // After the data has been deleted, redirect to the home (index) page
        return redirect()->route('home');
    }

    // The next two methods are to show the song and also edit the song comment

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit_comment(Request $request)
    {

        // Updates the comment for the song in the songs table
        $comment = Song::where('id',$request->id)->first();
        $comment->comment = $request->comment;
        $comment->save();

        // Store the song ID into a variable
        $id = $request->id;

        // Push the album ID to the show-album view
        return redirect()->route('show-song', compact('id'));
    }

}
