<?php namespace Mberizzo\Mercadopago\Components;

use Auth;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

class IsSubscribed extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'IsSubscribed Component',
            'description' => 'Detect if user is_subscribed else redirect'
        ];
    }

    public function defineProperties()
    {
        return [
            'redirect' => [
                'title' => 'Redirect',
                'description' => '',
                'type'        => 'dropdown',
                'default'     => ''
            ],
        ];
    }

    public function getRedirectOptions()
    {
        return [''=>'- refresh page -', '0' => '- no redirect -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $user = Auth::getUser();

        if (! $user || ! $user->is_subscribed) {
            return Redirect($this->property('redirect'));
        }
    }
}
