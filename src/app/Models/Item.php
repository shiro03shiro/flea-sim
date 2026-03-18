<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','image_path','name', 'brand_name', 'price', 'description', 'condition','sold_flg'];

    public function categories(){
        return $this->belongsToMany(Category::class, 'item_category');
    }

    public function purchases(){
        return $this->belongsToMany(User::class, 'purchases')->withPivot('payment_method');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isLikedByAuthUser()
    {
        return auth()->check() && $this->likes->contains(auth()->id());
    }

    public function comments(){
        return $this->belongsToMany(User::class, 'comments')->withPivot('content');
    }
}