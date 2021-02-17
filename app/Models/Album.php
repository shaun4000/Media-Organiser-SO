<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'albums';

    protected $fillable = [
        'artist_name',
        'description',
        'album_name',
        'category'
    ];

     /**
     * This album belongs to one artist.
     */
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artists_id');
    }

    /**
     * This album has many songs.
     */
    public function songs()
    {
        return $this->hasMany(Song::class, 'albums_id');
    }
}
