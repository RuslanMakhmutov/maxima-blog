<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function category_main()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }
}
