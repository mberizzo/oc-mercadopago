<?php namespace Mberizzo\Mercadopago;

use Backend;
use System\Classes\PluginBase;

/**
 * Mercadopago Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Mercadopago',
            'description' => 'No description provided yet...',
            'author'      => 'Mberizzo',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Mberizzo\Mercadopago\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'mberizzo.mercadopago.some_permission' => [
                'tab' => 'Mercadopago',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'mercadopago' => [
                'label'       => 'Mercadopago',
                'url'         => Backend::url('mberizzo/mercadopago/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['mberizzo.mercadopago.*'],
                'order'       => 500,
            ],
        ];
    }
}
