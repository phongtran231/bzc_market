<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_owners', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100)->nullable()->index();
            $table->string('phone', 20)->unique();
            $table->string('email', 100)->unique();
            $table->string('address')->nullable();
            $table->string('password', 60)->nullable();
            $table->rememberToken();
            $table->boolean('active')->nullable()->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_owners');
    }
}
