<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    protected $guarded = []; 

    // public function tag(string $name): void
    // {
    //     $tag = Tag::firstOrCreate(['name' => strtolower($name)]);
    //     $this->tags()->attach($tag);
    // }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where(function ($query) use ($value) {
            // Check for "active" or "inactive" first to handle the status filter
            if (strtolower($value) === 'fe' || strtolower($value) === 'fea' || strtolower($value) === 'featured' ) {
                $query->where('featured', 1);
            } elseif (strtolower($value) === 'un' ||strtolower($value) === 'unf' || strtolower($value) === 'unfea' || strtolower($value) === 'unfeatured') {
                $query->where('featured', 0);
            } else {
                // Perform general search on title and description if not "active" or "inactive"
                $query->where('title', 'like', '%' . $value . '%')
                    ->orWhere('location', 'like', '%' . $value . '%');
            }
        })
            ->orWhereHas('employer', function ($query) use ($value) {
                $query->where('name', 'like', '%' . $value . '%');
            });
    }
}
