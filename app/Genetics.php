<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genetics extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'alias', 'description',
    ];

    public function reproducers()
    {
        return $this->hasMany(Reproducer::class);
    }

    public function semen()
    {
        return $this->hasMany(Semen::class);
    }
}
