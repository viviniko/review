<?php

namespace Viviniko\Review\Contracts;

interface ReviewService
{
    /**
     * Paginate reviews.
     *
     * @param mixed $query
     *
     * @return \Common\Repository\Builder
     */
    public function search($query);

    /**
     * Find review by its id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create new review.
     *
     * @param mixed $reviewable
     * @param array $data
     * @return mixed
     */
    public function review($reviewable, $data);

    /**
     * Update review specified by it's id.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Delete review with provided id.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Count reviews.
     *
     * @param $reviewable
     * @return int
     */
    public function count($reviewable);

    /**
     * Avg rating.
     *
     * @param $reviewable
     * @return mixed
     */
    public function avgRating($reviewable);
}