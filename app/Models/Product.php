<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $gurdeud=[];

    public function cat(){
        return $this->belongsTo(Categorie::class,"cat_id");
    }
}
