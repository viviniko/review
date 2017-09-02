<?php

namespace Viviniko\Review\Services\Review;

use Viviniko\Repository\SimpleRepository;
use Viviniko\Review\Contracts\ReviewService as ReviewServiceInterface;
use Viviniko\Support\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class EloquentReview extends SimpleRepository implements ReviewServiceInterface
{
    protected $modelConfigKey = 'review.review';

    /**
     * Add review.
     *
     * @param Model $reviewable
     * @param array $data
     * @return mixed
     */
    public function review($reviewable, $data)
    {
        $user = Auth::user();
        return $this->create(array_merge([
            'reviewable_type' => $reviewable->getMorphClass(),
            'reviewable_id' => $reviewable->id,
            'user_id' => $user->id,
            'nickname' => $user->name,
            'ip' => Request::ip(),
            'is_approved' => false,
        ], $data));
    }

    /**
     * Count reviews.
     *
     * @param $reviewable
     * @return int
     */
    public function count($reviewable)
    {
        return $this->find([
            'reviewable_type' => $reviewable->getMorphClass(),
            'reviewable_id' => $reviewable->id,
        ])->count();
    }

    /**
     * Avg rating.
     *
     * @param $reviewable
     * @return mixed
     */
    public function avgRating($reviewable)
    {
        $rating = $this->findBy([
            'reviewable_type' => $reviewable->getMorphClass(),
            'reviewable_id' => $reviewable->id,
        ], null,'rating')->avg('rating');

        return sprintf('%.1f', $rating);
    }
}