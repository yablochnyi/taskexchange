<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $guarded = false;

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'task_options');
    }


}
