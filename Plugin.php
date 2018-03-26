<?php namespace Mberizzo\Mercadopago;

use Backend;
use Event;
use Mberizzo\Mercadopago\Models\Settings;
use RainLab\User\Models\User;
use System\Classes\PluginBase;

/**
 * Mercadopago Plugin Information File
 */
class Plugin extends PluginBase
{

    public $require = ['RainLab.User'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name' => 'mberizzo.mercadopago::lang.plugin.name',
            'description' => 'mberizzo.mercadopago::lang.plugin.description',
            'author'      => 'Mberizzo',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function($model) {
            $model->hasOne['subscription'] = 'Mberizzo\Mercadopago\Models\Subscription';
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Mberizzo\Mercadopago\Components\SubscriptionButton' => 'subscriptionButton',
            'Mberizzo\Mercadopago\Components\IsSubscribed' => 'userIsSubscribed',
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

    public function registerSettings()
    {
        return [];

        return [
            'subscription' => [
                'label' => 'mberizzo.mercadopago::lang.plugin.name',
                'description' => 'mberizzo.mercadopago::lang.setting_description',
                'category' => 'system::lang.system.categories.system',
                'icon' => 'icon-credit-card',
                'class' => 'Mberizzo\Mercadopago\Models\Settings',
                'permissions' => ['*'],
            ],
        ];
    }
}
