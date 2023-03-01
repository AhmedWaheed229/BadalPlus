<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $guarded = ['id'];
    protected $appends = ['image_url', 'name'];
    public $timestamps = true;
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime',];

    public function getImageUrlAttribute()
    {
        if ($this->image){
            return asset('images/users/' . $this->image);
        } else{
            return asset('images/users/avatar.png');
        }
    }
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function scopeActive()
    {
        return $this->where('active', 1);
    }

    public function currency(){
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function soldPosts(){
        return $this->hasMany(Post::class, 'created_by')->where('status', 0);
    }
    public function boughtPosts(){
        return $this->hasMany(Post::class, 'bought_by')->where('status', 0);
    }
}
