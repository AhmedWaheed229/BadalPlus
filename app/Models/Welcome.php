<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Welcome extends Model
{
    use HasFactory;
    protected $table = 'welcomes';
    protected $guarded = ["id"];
    protected $appends = ['content'];
    public $timestamps = true;

    public function getContentAttribute()
    {
        return $this['content_'.app()->getLocale()];
    }
    public function scopeActive()
    {
        return $this->where('active', 1);
    }
    public function scopeTitle()
    {
        return $this->where('type', 'title');
    }
    public function scopeList()
    {
        return $this->where('type', 'list');
    }
}
