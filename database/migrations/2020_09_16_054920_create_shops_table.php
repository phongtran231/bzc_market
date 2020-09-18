<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('slug')->nullable()->index();
            $table->string('prefix_sku', 10)->nullable()->index();
            $table->string('des')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('shop_owner_id')->index();
            $table->integer('img_quota')->nullable()->default(200);
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
        Schema::dropIfExists('shops');
    }
}
