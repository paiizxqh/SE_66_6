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
        Schema::create('set_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('product_set_id');
            $table->foreign('product_set_id')
                ->references('id')
                ->on('product_set')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('inventory')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_detail');
    }
};
