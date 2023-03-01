<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $guarded = ["id"];
    protected $appends = ['name', 'logo', 'address', 'content', 'icon_url', 'logo_ar_url', 'logo_en_url'];
    public $timestamps = true;

    public function getNameAttribute()
    {
        return $this['name_'.app()->getLocale()];
    }
    public function getLogoAttribute()
    {
        return asset('images/settings/'. $this['logo_'.app()->getLocale()]);
    }
    public function getAddressAttribute()
    {
        return $this['address_'.app()->getLocale()];
    }
    public function getContentAttribute()
    {
        return $this['content_'.app()->getLocale()];
    }
    public function getIconUrlAttribute()
    {
        return asset('images/settings/'. $this->icon);
    }
    public function getLogoArUrlAttribute()
    {
        return asset('images/settings/'. $this->logo_ar);
    }
    public function getLogoEnUrlAttribute()
    {
        return asset('images/settings/'. $this->logo_en);
    }
}
