<?php namespace Mberizzo\Mercadopago\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('mberizzo_mercadopago_subscriptions', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('preapproval_id');
            $table->string('status');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mberizzo_mercadopago_subscriptions');
    }
}
