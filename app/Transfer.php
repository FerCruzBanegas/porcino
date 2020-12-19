<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['reproducer_id', 'location_id'];

    public function reproducer()
    {
        return $this->belongsTo(Reproducer::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
