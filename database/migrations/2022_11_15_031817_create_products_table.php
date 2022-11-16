<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            for($i = 0; $i < 50; $i++){
                $table->string('property'.$i)->nullable()->default(null);
            }

            $table->string('batch_number')->nullable()->default(null);
            $table->string('data_hash')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();

            $table->index('batch_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
