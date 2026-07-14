<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['article_id', 'author_name', 'author_email', 'body', 'is_approved'];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
