<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Industry extends Model
{
    use HasFactory;

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }

    public function employers(): HasMany
    {
        return $this->hasMany(Employer::class);
    }
}
