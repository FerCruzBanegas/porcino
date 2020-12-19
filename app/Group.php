<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['date', 'code', 'observation', 'location_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function relocations()
    {
        return $this->hasMany(Relocation::class);
    }

    #public function reproducers()
    #{
    #    return $this->belongsToMany(Reproducer::class);
    #}

    public function weaning()
    {
        return $this->belongsToMany(Weaning::class)->withPivot('females', 'males');
    }

    public function grouptreatments()
    {
        return $this->hasMany(GroupTreatment::class);
    }

    public function groupdeaths()
    {
        return $this->hasMany(DeathGroup::class);
    }

    public function moves()
    {
        return $this->hasMany(Move::class);
    }
}
