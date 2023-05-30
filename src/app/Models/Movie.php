<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'director_id', 'description', 'price', 'year'];

    public function director()
    {
        return $this->belongsTo(Director::class);
    }
}
