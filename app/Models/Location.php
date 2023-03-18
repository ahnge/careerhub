<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function jobPostings(): HasMany
    {
        return $this->hasMany(jobPosting::class);
    }

    public function employers(): HasMany
    {
        return $this->hasMany(Employer::class);
    }
}
