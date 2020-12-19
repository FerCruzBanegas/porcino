<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insemination extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'date', 'time', 'dose', 'observation', 'reproducer_id', 'semen_id',
    ];

    public function reproducer()
    {
        return $this->belongsTo(Reproducer::class);
    }

    public function semen()
    {
        return $this->belongsTo(Semen::class);
    }
}
