<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'due_date',
        'status_id',
        'deleted_at'

    ];

    protected $returnType = 'object';

     public function Status() {
        return $this->belongsTo(Status::class);
    }


    public function User_tasks() {
        return $this->hasMany(User_tasks::class);
    }




}
