<?php

namespace Viviniko\Review\Services;

use Viviniko\Review\Repositories\ReviewRepository;
use Viviniko\Support\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ReviewServiceImpl implements ReviewService
{
    protected $repository;

    public function __construct(ReviewRepository $repository)
    {
        $this->repository = $repository;
    }

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
        return $this->repository->count([
            'reviewable_type' => $reviewable->getMorphClass(),
            'reviewable_id' => $reviewable->id,
        ]);
    }

    /**
     * Avg rating.
     *
     * @param $reviewable
     * @return mixed
     */
    public function avgRating($reviewable)
    {
        $rating = $this->repository->findAllBy([
            'reviewable_type' => $reviewable->getMorphClass(),
            'reviewable_id' => $reviewable->id,
        ], null,['rating'])->avg('rating');

        return sprintf('%.1f', $rating);
    }

    /**
     * Paginate the given query into a simple paginator.
     *
     * @param null $perPage
     * @param string $searchName
     * @param null $search
     * @param null $order
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $searchName = null, $search = null, $order = null)
    {
        return $this->repository->paginate($perPage, $searchName, $search, $order);
    }

    /**
     * Find review by its id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update review specified by it's id.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete review with provided id.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}