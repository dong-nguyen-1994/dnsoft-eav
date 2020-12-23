<?php

namespace Dnsoft\Eav\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Dnsoft\Eav\EavServiceProvider;
use Dnsoft\Eav\Repositories\AttributeRepositoryInterface;

class AttributeRepository implements AttributeRepositoryInterface
{
    /** @var Model|\Eloquent */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
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
        $data['type'] = EavServiceProvider::$mapInputType[$data['input_type']];
        $data['is_collection'] = EavServiceProvider::$isCollection[$data['input_type']];

        $attribute = $this->model->create($data);

        $attribute->entities()->firstOrCreate(['entity_type' => $entityType]);

        return $attribute;
    }

    public function update($entityType, array $data, $id)
    {
        $attribute = $this->find($id);

        if (!empty($data['input_type'])) {
            $data['type'] = EavServiceProvider::$mapInputType[$data['input_type']];
            $data['is_collection'] = EavServiceProvider::$isCollection[$data['input_type']];
        }

        $attribute->update($data);

        $attribute->entities()->firstOrCreate(['entity_type' => $entityType]);

        return $attribute;
    }

    public function delete($id)
    {
        $attibute = $this->find($id);

        return $attibute->delete();
    }

    public function all($entityType, $columns = ['*'])
    {
        return $this->model
            ->whereHas('entities', function (Builder $builder) use ($entityType) {
                $builder->where('entity_type', $entityType);
            })
            ->get();
    }
}
