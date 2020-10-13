<?php

namespace Dnsoft\Eav\Http\Controllers\Admin;

use Dnsoft\Eav\Repositories\AttributeRepositoryInterface;
use Illuminate\Routing\Controller;

abstract class AttributeController extends Controller
{
    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;

    abstract function getEntityType();

    abstract function getNamePrefixRoute();

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function index()
    {
        $items = $this->attributeRepository->paginate($this->getEntityType(), 20);
        return view('eav::admin.attribute.index', [
            'items'           => $items,
            'routeNamePrefix' => $this->getNamePrefixRoute(),
        ]);
    }

    public function create()
    {
        return view('eav::admin.attribute.create')->with([
            'routeNamePrefix' => $this->getNamePrefixRoute(),
            'item' => null
        ]);
    }
}
