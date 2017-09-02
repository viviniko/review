<?php

namespace Viviniko\Review;

use Illuminate\Support\Facades\Config;

trait Reviewable
{
    public function reviews()
    {
        return $this->morphMany(Config::get('review.review'), 'reviewable');
    }

    abstract public function getReviewableNameAttribute();
}