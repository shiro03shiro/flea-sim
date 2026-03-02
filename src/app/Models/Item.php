<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand_name', 'price', 'description', 'condition'];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('payment_method', 'content');
    }
}