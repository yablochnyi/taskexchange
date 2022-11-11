<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';
    protected $guarded = false;

    public function parent()
    {
        return $this->belongsTo(Option::class, 'id');
    }

    public function children()
    {
        return $this->hasMany(Option::class, 'parent_id');
    }

    public function task_options()
    {
        return $this->hasOne(TaskOption::class);
    }
}
