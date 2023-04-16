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

    public function items() {
        return $this->hasMany(Item::class, 'item_id')->orderBy('title', 'ASC');
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
}