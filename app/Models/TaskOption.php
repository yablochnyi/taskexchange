<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskOption extends Model
{
    protected $table = 'task_options';
    protected $guarded = false;

    protected function task()
    {
        return $this->belongsTo(Task::class);
    }

    protected function option()
    {
        return $this->belongsTo(Option::class);
    }


}
