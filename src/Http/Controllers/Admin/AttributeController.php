<?php

namespace DnSoft\Eav\Http\Controllers\Admin;

use DnSoft\Core\Facades\MenuAdmin;
use DnSoft\Eav\Repositories\AttributeRepositoryInterface;
use DnSoft\Eav\Http\Requests\AttributeRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
    $version = get_version_actived();
    return view("eav::$version.admin.attribute.index", [
      'items'           => $items,
      'routeNamePrefix' => $this->getNamePrefixRoute(),
    ]);
  }

  public function create()
  {
    MenuAdmin::activeMenu($this->getAdminMenuId());
    session()->put('session_id', Str::random(20));
    $version = get_version_actived();
    return view("eav::$version.admin.attribute.create")->with([
      'routeNamePrefix' => $this->getNamePrefixRoute(),
      'item' => null
    ]);
  }

  public function store(AttributeRequest $request)
  {
    $item = $this->attributeRepository->create($this->getEntityType(), $request->all());

    if ($request->input('continue')) {
      return redirect()
        ->route($this->getNamePrefixRoute() . 'edit', $item->id)
        ->with('success', __('eav::attribute.notification.created'));
    }

    return redirect()
      ->route($this->getNamePrefixRoute() . 'index')
      ->with('success', __('eav::attribute.notification.created'));
  }

  public function edit($id)
  {
    MenuAdmin::activeMenu($this->getAdminMenuId());
    $item = $this->attributeRepository->find($id);
    session()->put('session_id', Str::random(20));
    $version = get_version_actived();
    return view("eav::$version.admin.attribute.edit")->with([
      'item'            => $item,
      'routeNamePrefix' => $this->getNamePrefixRoute(),
    ]);
  }

  public function update($id, AttributeRequest $request)
  {
    $item = $this->attributeRepository->update($this->getEntityType(), $request->all(), $id);

    if ($request->input('continue')) {
      return redirect()
        ->route($this->getNamePrefixRoute() . 'edit', $item->id)
        ->with('success', __('eav::attribute.notification.updated'));
    }

    return redirect()
      ->route($this->getNamePrefixRoute() . 'index')
      ->with('success', __('eav::attribute.notification.updated'));
  }

  public function destroy($id, Request $request)
  {
    $this->attributeRepository->delete($id);

    if ($request->ajax()) {
      Session::flash('success', __('eav::attribute.notification.deleted'));
      return response()->json([
        'success' => true,
      ]);
    }

    return redirect()
      ->route($this->getNamePrefixRoute() . 'index')
      ->with('success', __('eav::attribute.notification.deleted'));
  }
}
