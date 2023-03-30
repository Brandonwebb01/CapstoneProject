<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShoppingCart extends Model
{
    use HasFactory;
    public $table = 'shopping_cart';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    public function category() {
        return $this->hasOne('\App\Category','id', 'category_id')->orderBy('name','ASC');
    }

    public function items() {
        return $this->hasMany('\App\Item','id', 'category_id')->orderBy('name','ASC');
    }
}