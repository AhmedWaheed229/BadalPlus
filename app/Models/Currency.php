<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'currencies';
    protected $guarded = ["id"];
    protected $appends = ['name'];
    public $timestamps = true;

    public function getNameAttribute()
    {
        return $this['name_'.app()->getLocale()];
    }

    public function scopeActive()
    {
        return $this->where('active', 1);
    }

}
