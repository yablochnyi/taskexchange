<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }
}
