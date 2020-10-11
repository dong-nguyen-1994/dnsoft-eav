<?php

namespace Dnsoft\Eav;

use Dnsoft\Eav\Models\Attribute;
use Dnsoft\Eav\Repositories\AttributeRepository;
use Dnsoft\Eav\Repositories\AttributeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class EavServiceProvider extends ServiceProvider
{
    public function register()
    {
        //$this->app->singleton('rinvex.attributes.attribute', Attribute::class);

        $this->app->singleton(AttributeRepositoryInterface::class, function () {
            return new AttributeRepository(new Attribute());
        });
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'eav');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'eav');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/eav'),
        ], 'dnsoft-admin');

        //Blade::include('eav::form.attributes', 'attributes');

//        Attribute::typeMap([
//            self::TEXT     => \Rinvex\Attributes\Models\Type\Text::class,
//            self::BOOLEAN  => \Rinvex\Attributes\Models\Type\Boolean::class,
//            self::INTEGER  => \Rinvex\Attributes\Models\Type\Integer::class,
//            self::VARCHAR  => \Rinvex\Attributes\Models\Type\Varchar::class,
//            self::DATETIME => \Rinvex\Attributes\Models\Type\Datetime::class,
//            self::IMAGE    => \Newnet\Eav\Models\Type\Image::class,
//        ]);
//
//        Event::listen(CoreAdminMenuRegistered::class, function () {
//            AdminMenu::addItem(__('eav::menu.attribute.index'), [
//                'id'         => EavAdminMenuRegistered::ROOT_ID,
//                'parent'     => CoreAdminMenuRegistered::SYSTEM_ROOT_ID,
//                'href'       => '#',
//                'icon'       => 'fas fa-bezier-curve',
//                'order'      => 10,
//            ]);
//
//            event(new EavAdminMenuRegistered());
//        });
    }

}
