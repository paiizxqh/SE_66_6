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
        Schema::create('parameter_in_checkpoints', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('checkpoint_id');
            $table->foreign('checkpoint_id')
                ->references('id')
                ->on('checkpoints')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');

            $table->unsignedBigInteger('parameter_id');
            $table->foreign('parameter_id')
                ->references('id')
                ->on('parameters')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');

            $table->float('sample_value')->nullable();
            $table->dateTime('sample_date_time')->nullable();

            $table->unsignedBigInteger('academician_id');
            $table->foreign('academician_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION')
                ->nullable();

            $table->unsignedBigInteger('surveyor_id');
            $table->foreign('surveyor_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_in_checkpoints');
    }
};
