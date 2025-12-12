<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // THIS LINE IS REQUIRED FOR YOUR CONTROLLER TO WORK
    protected $fillable = ['name', 'email', 'age', 'course'];
}