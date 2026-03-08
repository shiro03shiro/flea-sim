<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand_name', 'price', 'description', 'condition'];

    public function categories(){
        return $this->belongsToMany(Category::class, 'item_category');
    }

    public function purchases(){
        return $this->belongsToMany(User::class, 'purchases')->withPivot('payment_method');
    }

    public function comments(){
        return $this->belongsToMany(User::class, 'comments')->withPivot('content');
    }
}