<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumePosition extends Model
{
    use HasFactory;

    protected $fillable = ['position_id', 'resume_id'];
}
