<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable =['name'];

    public function pro(){
        return $this->HasMany(Product::class,'cat_id');
    }
}