<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phase extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
