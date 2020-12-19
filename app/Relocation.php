<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relocation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['group_id', 'location_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
