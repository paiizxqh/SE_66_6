<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory',function(Blueprint $table){
            $table->increments('product_id');

            $table->unsignedInteger('product_type');
            $table->foreign('product_type')
                    ->references('type_id')
                    ->on('product_type')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION');

            $table->integer('product_remain');
            $table->integer('product_minimum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};