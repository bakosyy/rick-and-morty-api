<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function birthLocationCharacters()
    {
        return $this->hasMany(Character::class, 'birth_location_id');
    }

    public function currentLocationCharacters()
    {
        return $this->hasMany(Character::class,'current_location_id');
    }
}
