<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageDay extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'position', 'color_id'];

    public function manageTimes() {
        return $this->hasMany(ManageTime::class)->orderBy('time_from', 'ASC');
    }
}
