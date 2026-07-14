<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'category_id',
        'author_name',
        'published_at',
        'is_trending',
        'is_editor_pick',
        'is_lead',
        'video_url',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_trending' => 'boolean',
            'is_editor_pick' => 'boolean',
            'is_lead' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
