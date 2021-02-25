<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'playlist_name'
    ];

    /**
     * This song belongs to many playlists.
     */
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlists_songs', 'playlists_id', 'songs_id');
    }
}
