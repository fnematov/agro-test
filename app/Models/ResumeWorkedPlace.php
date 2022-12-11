<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResumeWorkedPlace extends Model
{
    use HasFactory;

    protected $fillable = ['resume_id', 'location_id', 'organization_name', 'job_title', 'beginning_of_work', 'ending_of_work'];

    public function location(): BelongsTo|Location
    {
        return $this->belongsTo(Location::class);
    }
}
