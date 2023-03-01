<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $guarded = ["id"];
    protected $appends = ['image_url', 'active_status'];
    public $timestamps = true;

    public function getImageUrlAttribute()
    {
        return asset('images/posts/' . $this->image);
    }
    public function getActiveStatusAttribute()
    {
        if ($this->active == 0){
            return __('pending');
        }elseif ($this->active == 1){
            return __('active');
        }elseif($this->active == 2){
            return __('inactive');
        }
        return __('pending');
    }

    public function scopeActive()
    {
        return $this->where('active', 1);
    }

    public function scopeStatus(){
        return $this->where('status', 1);
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function currency(){
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id')
            ->with('category');
    }
}
