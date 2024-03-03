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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employees_id',10);
            $table->primary('employees_id');

            $table->string('employees_fname',100);
            $table->string('employees_lname',100);
            $table->string('password',100);

            $table->unsignedInteger('roles_id');
            $table->foreign('roles_id')
                    ->references('roles_id')
                    ->on('roles')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION');
                    
            $table->unsignedInteger('departments_id');
            $table->foreign('departments_id')
                    ->references('departments_id')
                    ->on('departments')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
