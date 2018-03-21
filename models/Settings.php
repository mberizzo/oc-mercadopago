<?php namespace Mberizzo\Mercadopago\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{

    public $implement = [
        'System.Behaviors.SettingsModel',
    ];

    public $settingsCode = 'mberizzo_mercadopago_settings';

    public $settingsFields = 'fields.yaml';
}
