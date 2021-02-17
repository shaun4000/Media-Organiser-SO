<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

    protected $fillable = [
        'artist_name',
        'description'
    ];

    /**
     * This artist has many albums.
     */
    public function albums()
    {
        return $this->hasMany(Album::class, 'artists_id');
    }
}
