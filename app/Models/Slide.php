<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    protected $table = 'slides';
    protected $guarded = ["id"];
    protected $appends = ['title', 'icon_url'];
    public $timestamps = true;

    public function getTitleAttribute()
    {
        return $this['title_'.app()->getLocale()];
    }

    public function getIconUrlAttribute()
    {
        return asset('images/slides/' . $this->icon);
    }
    public function scopeActive()
    {
        return $this->where('active', 1);
    }

    public function lists(){
        return $this->hasMany(SlideList::class, 'slide_id')->where('active', '=', 1);
    }
}
