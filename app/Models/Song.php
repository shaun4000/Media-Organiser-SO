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
        'song_name'
    ];

     /**
     * This song belongs to one album.
     */
    public function album()
    {
        return $this->belongsTo(Album::class, 'albums_id');
    }
}
