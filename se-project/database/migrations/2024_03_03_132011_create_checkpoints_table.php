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
        Schema::create('checkpoints', function (Blueprint $table) {
            $table->increments('checkpoint_id');
            $table->integer('checkpoint_number');

            $table->unsignedInteger('projects_id');
            $table->foreign('projects_id')
                    ->references('projects_id')
                    ->on('projects')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkpoints');
    }
};
