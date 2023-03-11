<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(Employer::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
