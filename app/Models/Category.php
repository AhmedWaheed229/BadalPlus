<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = ["id"];
    protected $appends = ['name', 'image_url'];
    public $timestamps = true;

    public function getNameAttribute()
    {
        return $this['name_'.app()->getLocale()];
    }

    public function getImageUrlAttribute()
    {
        if ($this->image){
            return asset('images/categories/' . $this->image);
        } else{
            return null;
        }
    }
    public function scopeActive()
    {
        return $this->where('active', 1);
    }

    public function scopeMain()
    {
        return $this->where('parent_id', 0);
    }
    public function scopeMainActive()
    {
        return $this->where('parent_id', 0)->where('active', 1);
    }

    public function subCategories(){
        return $this->hasMany(Category::class, 'parent_id')->where('active', '=', 1);
    }

    public function category(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
