<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyUs extends Model
{
    use HasFactory;
    protected $table = 'why_us';
    protected $guarded = ["id"];
    protected $appends = ['title', 'icon_url', 'description'];
    public $timestamps = true;

    public function getTitleAttribute()
    {
        return $this['title_'.app()->getLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this['description_'.app()->getLocale()];
    }

    public function getIconUrlAttribute()
    {
        if ($this->icon){
            return asset('images/why_us/' . $this->icon);
        } else{
            return null;
        }
    }
    public function scopeActive()
    {
        return $this->where('active', 1);
    }
}
