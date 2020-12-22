<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ["user_id", "title", "description", "price", "image"];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
