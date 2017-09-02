<?php

namespace Viviniko\Review\Models;

use Viviniko\Support\Database\Eloquent\Model;

class Review extends Model
{
    protected $tableConfigKey = 'review.reviews_table';

    protected $fillable = [
        'reviewable_type', 'reviewable_id', 'content', 'user_id', 'nickname', 'rating', 'ip', 'is_approved'
    ];

    /**
     * Get all of the owning reviewable models.
     */
    public function reviewable()
    {
        return $this->morphTo();
    }
}