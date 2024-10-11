<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'title', 'product_list_id', 'price', 'rate'];

    public function productList() 
    {
        return $this->BelongsTo(ProductList::class);
    }    
}
