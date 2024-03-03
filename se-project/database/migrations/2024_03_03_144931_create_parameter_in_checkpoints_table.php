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
            $table->increments('sample_id');

            $table->unsignedInteger('checkpoint_id');
            $table->foreign('checkpoint_id')
                    ->references('checkpoint_id')
                    ->on('checkpoints')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION');

            $table->unsignedInteger('parameter_id');        
            $table->foreign('parameter_id')
                    ->references('parameter_id')
                    ->on('parameter')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION');
            
            $table->float('sample_value')->nullable();
            $table->dateTime('sample_date_time')->nullable();

            $table->string('academician_id',10);
            $table->foreign('academician_id')
                    ->references('employees_id')
                    ->on('employees')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION')
                    ->nullable();
            
            $table->string('surveyor_id',10);
            $table->foreign('surveyor_id')
                    ->references('employees_id')
                    ->on('employees')
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
