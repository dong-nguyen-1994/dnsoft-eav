<?php

namespace Dnsoft\Eav\Repositories;

use Dnsoft\Eav\Models\Attribute;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AttributeRepository implements AttributeRepositoryInterface
{
    public $model;
    /**
     * AttributeRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all($entityType, $columns = ['*'])
    {
        // TODO: Implement all() method.
    }

    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function paginate($entityType, $itemPerPage = 20)
    {
        return $this->model
            ->whereHas('entities', function (Builder $builder) use ($entityType) {
                $builder->where('entity_type', $entityType);
            })
            ->paginate($itemPerPage);
    }

    public function create($entityType, array $data)
    {
        // TODO: Implement create() method.
    }

    public function update($entityType, array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $attibute = $this->find($id);

        return $attibute->delete();
    }
}
