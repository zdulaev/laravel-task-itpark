<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function movies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Movie::class, 'movie_genre');
    }
}
