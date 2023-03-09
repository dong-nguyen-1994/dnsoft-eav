<?php

namespace DnSoft\Eav\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use DnSoft\Eav\Models\Attribute;

interface AttributeRepositoryInterface
{
    /**
     * @param $entityType
     * @param  string[]  $columns
     * @return Collection
     */
    public function all($entityType, $columns = ['*']);

    /**
     * @param $id
     * @param  string[]  $columns
     * @return Attribute
     */
    public function find($id, $columns = ['*']);

    /**
     * @param $entityType
     * @param  int  $itemPerPage
     * @return LengthAwarePaginator
     */
    public function paginate($entityType, $itemPerPage = 20);

    /**
     * @param $entityType
     * @param  array  $data
     * @return Attribute
     */
    public function create($entityType, array $data);

    /**
     * @param $entityType
     * @param  array  $data
     * @param $id
     * @return Attribute
     */
    public function update($entityType, array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
