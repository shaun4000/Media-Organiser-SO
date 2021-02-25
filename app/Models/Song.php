<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'songs';

    protected $fillable = [
        'albums_id',
        'song_name',
        'file_name',
        'file_type',
        'file_size',
        'file_location',
        'comment'
    ];

     /**
     * This song belongs to one album.
     */
    public function album()
    {
        return $this->belongsTo(Album::class, 'albums_id');
    }

    /**
     * This song belongs to many playlists.
     */
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlists_songs', 'songs_id', 'playlists_id');

    }


}
