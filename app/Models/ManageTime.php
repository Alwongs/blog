<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTime extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'manage_day_id', 'status', 'time_from', 'time_to'];

    public function manageDay() {
        return $this->belongsTo(ManageDay::class);
    }
}
