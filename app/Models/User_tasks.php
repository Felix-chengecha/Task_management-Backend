<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User_tasks extends Model
{
    use HasFactory;



    protected $fillable=[
        'user_id',
        'tasks_id',
        'due_date',
        'start_time',
        'end_time',
        'remarks',
        'status_id',

    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Tasks() {
        return $this->belongsTo(Tasks::class);
    }

    public function Status() {
        return $this->belongsTo(Status::class);
    }
}
