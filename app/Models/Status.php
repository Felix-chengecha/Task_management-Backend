<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable=[
        'status_name'
    ];

    public function Tasks() {
        return $this->hasMany(Tasks::class);
    }

    public function User_tasks() {
        return $this->hasMany(User_tasks::class);
    }


}
