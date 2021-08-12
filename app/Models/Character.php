<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public static function add($request)
    {
        $character = new Character;
        $character->fill($request);
        $character->save();

        return $character;
    }

    public function edit($request)
    {
        $this->fill($request);
        $this->save();

        return $this;
    }
}
