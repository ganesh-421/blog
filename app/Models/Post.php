<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // protected $fillable = ['title', 'excerpt', 'body']; 
    protected $guarded = ['id'];
    protected $with = ['category', 'author']; //for eager loading and eliminating with() in route file.
    // route key name (alter from id)
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // filter
    public function scopeFilter($query, array $filters)
    {
        $query
            ->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn ($query) =>
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')));
        $query
            ->when(
                $filters['category'] ?? false,
                fn ($query, $category) =>
                $query->whereHas('category', fn ($query) =>
                $query->where('categories.slug', $category))
            );
        $query
            ->when(
                $filters['rating'] ?? false,
                fn ($query, $author) =>
                $query->whereHas('author', fn ($query) =>
                $query->where('username', $author))
            );
    }
}
