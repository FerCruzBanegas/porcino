<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weaning extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = ['date', 'quantity', 'weight', 'average', 'observation', 'reproducer_id'];

    public function reproducer()
    {
        return $this->belongsTo(Reproducer::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
