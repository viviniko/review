<?php

namespace Viviniko\Review\Repositories;

use Illuminate\Support\Facades\Config;
use Viviniko\Repository\EloquentRepository;

class EloquentReview extends EloquentRepository implements ReviewRepository
{
    public function __construct()
    {
        parent::__construct(Config::get('review.review'));
    }

}