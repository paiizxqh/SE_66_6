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
            $table->unsignedInteger('set_id');
            $table->foreign('set_id')
                    ->references('set_id')
                    ->on('product_set')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                    ->references('product_id')
                    ->on('inventory')
                    ->onUpdate('NO ACTION')
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
