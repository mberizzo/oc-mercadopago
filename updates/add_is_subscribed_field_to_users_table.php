<?php namespace Mberizzo\Mercadopago\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddIsSubscribedFieldToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->boolean('is_subscribed')->default(0);
        });
    }

    public function down()
    {
        Schema::dropColumn('is_subscribed');
    }
}
