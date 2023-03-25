<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Str;

class Employer extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // Auto generate slug when creating a new job posting
        static::creating(function ($employer) {
            $slug = Str::slug($employer->company_name);
            $employer->slug = Employer::makeSlugUnique($slug);
        });

        // Auto update slug when updating a job posting
        static::updating(function ($employer) {
            if ($employer->isDirty('company_name')) {
                $slug = Str::slug($employer->company_name);
                $employer->slug = Employer::makeSlugUnique($slug, $employer->id);
            }
        });
    }

    // Helper method to make slug unique
    public static function makeSlugUnique($slug, $postId = null)
    {
        $count = static::where('slug', 'like', "{$slug}%")
            ->when($postId, function ($query) use ($postId) {
                $query->where('id', '!=', $postId);
            })
            ->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }
        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }
}
