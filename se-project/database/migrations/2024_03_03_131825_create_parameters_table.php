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
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('parameter_fullname');
            $table->string('parameter_shortname');
            $table->string('parameter_unit');

            $table->unsignedBigInteger('product_set_id');
            $table->foreign('product_set_id')
                ->references('id')
                ->on('product_set')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};
