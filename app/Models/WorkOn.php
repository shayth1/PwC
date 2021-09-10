<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOn extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'employee_id'
    ];
}