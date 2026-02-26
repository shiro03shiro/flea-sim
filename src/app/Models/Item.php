<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand_name', 'price', 'description', 'condition'];
    protected $guarded = ['id', 'user_id', 'category_id', 'image_path', 'sold_flg'];
}