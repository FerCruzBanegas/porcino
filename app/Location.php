<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'shed', 'room', 'capacity', 'phase_id',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function reproducers()
    {
        return $this->hasMany(Reproducer::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function relocations()
    {
        return $this->hasMany(Relocation::class);
    }
}
