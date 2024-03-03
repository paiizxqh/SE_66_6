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
        Schema::create('project_members', function (Blueprint $table) {
           $table->string('projects_id',10);
           $table->foreign('projects_id')
                    ->references('projects_id')
                    ->on('projects')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION'); 

            $table->string('employees_id',10);
            $table->foreign('employees_id')
                    ->references('employees_id')
                    ->on('employees')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_members');
    }
};
