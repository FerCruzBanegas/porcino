<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reproducer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code', 'origin', 'arrival', 'price', 'weight', 'birth', 'sex', 'condition', 'observation', 'genectis_id', 'location_id',
    ];

    public function genetics()
    {
        return $this->belongsTo(Genetics::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function extractions()
    {
        return $this->hasMany(Extraction::class);
    }

    public function inseminations()
    {
        return $this->hasMany(Insemination::class);
    }

    public function weaning()
    {
        return $this->hasMany(Weaning::class);
    }

    public function abortions()
    {
        return $this->hasMany(Abortion::class);
    }

    public function death()
    {
        return $this->hasOne(Death::class);
    }

    public function deathbreending()
    {
        return $this->hasMany(DeathBreeding::class);
    }

    public function births()
    {
        return $this->hasMany(Birth::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    #public function groups()
    #{
    #    return $this->belongsToMany(Group::class);
    #}
}
