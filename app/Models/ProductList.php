<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\Status;

class ProductList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id'];

    public function products() {
        return $this->hasMany(Product::class)->orderBy('status', 'ASC');
    }

    public function activeProducts() {
        return $this->hasMany(Product::class)->where('status', Status::ACTIVE);
    }
}
