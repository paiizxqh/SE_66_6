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
        Schema::create('parameter', function (Blueprint $table) {
            $table->increments('parameter_id');
            $table->string('parameter_fullname', 50);
            $table->string('parameter_shortname', 50);
            $table->string('parameter_unit',20);

            $table->unsignedInteger('set_id');
            $table->foreign('set_id')
                    ->references('set_id')
                    ->on('product_set')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter');
    }
};
