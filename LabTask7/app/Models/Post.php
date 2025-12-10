<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'body'];

    // Post belongs to User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Post has many Comments
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Post belongs to many Categories
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}