<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideList extends Model
{
    use HasFactory;
    protected $table = 'slide_lists';
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

    public function slide(){
        return $this->belongsTo(Slide::class, 'slide_id');
    }
}
