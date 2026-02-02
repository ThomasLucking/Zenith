<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Import it
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory; // 2. Use it inside the class

    protected $fillable = ['title', 'description', 'is_completed'];
}