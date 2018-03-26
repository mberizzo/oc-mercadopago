<?php namespace Mberizzo\Mercadopago\Models;

use Model;

/**
 * Subscription Model
 */
class Subscription extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'mberizzo_mercadopago_subscriptions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['preapproval_id', 'status', 'user_id'];
}
