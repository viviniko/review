<?php

namespace Viviniko\Review\Repositories;

interface ReviewRepository
{
    /**
     * Paginate the given query into a simple paginator.
     *
     * @param null $perPage
     * @param string $searchName
     * @param null $search
     * @param null $order
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $searchName = null, $search = null, $order = null);

    /**
     * Find review by its id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    public function findAllBy($column, $value = null, $columns = ['*']);

    public function update($id, array $data);

    public function delete($id);

    public function count($column, $value = null);
}