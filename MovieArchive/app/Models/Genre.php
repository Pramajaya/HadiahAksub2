<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'GenreName'
    ];

    public function movie(): HasMany
    {
        return $this->hasMany(Movie::class, 'GenreId');
    }
}
