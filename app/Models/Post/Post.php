<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = false;

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    public function getImageAttribute()
    {
        return 'storage/' . $this->main_image;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
