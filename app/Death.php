<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Death extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['date', 'reason', 'weight', 'observation', 'reproducer_id'];

    public function reproducer()
    {
        return $this->belongsTo(Reproducer::class);
    }
}
