<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class JobPosting extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // Auto generate slug when creating a new job posting
        static::creating(function ($jobPosting) {
            $slug = Str::slug($jobPosting->title);
            $jobPosting->slug = JobPosting::makeSlugUnique($slug);
        });

        // Auto update slug when updating a job posting
        static::updating(function ($jobPosting) {
            if ($jobPosting->isDirty('title')) {
                $slug = Str::slug($jobPosting->title);
                $jobPosting->slug = JobPosting::makeSlugUnique($slug, $jobPosting->id);
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

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(JobSeeker::class, 'applications');
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function jobFunction(): BelongsTo
    {
        return $this->belongsTo(JobFunction::class);
    }
}
