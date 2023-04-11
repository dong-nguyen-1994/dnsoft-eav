<?php

namespace DnSoft\Eav;

use DnSoft\Core\Events\CoreAdminMenuRegistered;
use DnSoft\Eav\Events\EavAdminMenuRegistered;
use DnSoft\Eav\Models\Attribute;
use DnSoft\Eav\Repositories\AttributeRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EavServiceProvider extends ServiceProvider
{
  const TEXT = 'text';
  const BOOLEAN = 'boolean';
  const INTEGER = 'integer';
  const VARCHAR = 'varchar';
  const DATETIME = 'datetime';
  const IMAGE = 'image';

  public static $mapInputType = [
    'text'            => self::VARCHAR,
    'textarea'        => self::TEXT,
    'editor'          => self::TEXT,
    'yes_no'          => self::BOOLEAN,
    'multiple_select' => self::INTEGER,
    'dropdown'        => self::INTEGER,
    'image'           => self::IMAGE,
    'gallery'         => self::IMAGE,
  ];

  public static $isCollection = [
    'text'            => false,
    'textarea'        => false,
    'editor'          => false,
    'yes_no'          => false,
    'multiple_select' => true,
    'dropdown'        => false,
    'image'           => false,
    'gallery'         => true,
  ];

  public function register()
  {
    //$this->app->singleton('rinvex.attributes.attribute', Attribute::class);

    $this->app->singleton(AttributeRepositoryInterface::class, function () {
      return new \DnSoft\Eav\Repositories\Eloquents\AttributeRepository(new Attribute());
    });
  }

  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'eav');
    $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'eav');

    $this->publishes([
      __DIR__ . '/../public/v1' => public_path('vendor/eav/v1'),
    ], 'dnsoft-eav-v1');

    $this->publishes([
      __DIR__ . '/../public/v2' => public_path('vendor/eav/v2'),
    ], 'dnsoft-eav-v2');

    Blade::include('eav::v2.admin.form.attributes', 'attributes');

    require_once __DIR__ . '/../helpers/helpers.php';

    Attribute::typeMap([
      self::TEXT     => \Dnsoft\Eav\Models\Type\Text::class,
      self::BOOLEAN  => \Rinvex\Attributes\Models\Type\Boolean::class,
      self::INTEGER  => \Rinvex\Attributes\Models\Type\Integer::class,
      self::VARCHAR  => \DnSoft\Eav\Models\Type\Varchar::class,
      self::DATETIME => \Rinvex\Attributes\Models\Type\Datetime::class,
      self::IMAGE    => \DnSoft\Eav\Models\Type\Image::class,
    ]);

    Event::listen(CoreAdminMenuRegistered::class, function ($menu) {

      //            $menu->add('Customer', ['id' => 'customer'])->data('order', 2000)->prepend('<i class="fas fa-users"></i>');
      //            $menu->add('Customer', ['route' => 'customer.admin.customer.index', 'parent' => $menu->customer->id]);

      event(new EavAdminMenuRegistered(), $menu);
    });
  }
}
