<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'full_text',
        'image',
        'user_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters = [])
    {
        $query->when(isset($filters['article']) && $filters['article'], function ($query, $searchTerm) {
            return $query->where('title', 'like', '%' . $searchTerm . '%');
        })
            ->when(isset($filters['category']) && $filters['category'], function ($query, $category) {
                return $query->whereHas('category', function ($query) use ($category) {
                    return $query->where('name', 'like', '%' . $category . '%');
                });
            })
            ->when(isset($filters['tag']) && $filters['tag'], function ($query, $tag) {
                return $query->whereHas('tags', function ($query) use ($tag) {
                    return $query->where('name', 'like', '%' . $tag . '%');
                });
            });
    }
}
