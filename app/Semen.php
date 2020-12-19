<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semen extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code', 'genetics_id',
    ];

    public function inseminations()
    {
        return $this->hasMany(Insemination::class);
    }

    public function genetics()
    {
        return $this->belongsTo(Genetics::class);
    }
}
