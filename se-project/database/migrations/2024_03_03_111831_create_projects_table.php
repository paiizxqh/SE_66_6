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
        Schema::create('projects', function (Blueprint $table) {
            $table->string('projects_id',10);
            $table->primary('projects_id');
            
            $table->date('projects_start_date');
            $table->date('projects_area_date');
            $table->string('projects_map');
            $table->string('customers_contact_name');
            $table->string('customers_contact_phone');

            $table->unsignedInteger('status_id');
            $table->foreign('status_id')
                    ->references('status_id')
                    ->on('project_status')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION'); 

            $table->string('customers_id',10);
            $table->foreign('customers_id')
                        ->references('customers_id')
                        ->on('customers')
                        ->onUpdate('cascade')
                        ->onDelete('NO ACTION');   

            $table->string('assistant_id',10);
            $table->foreign('assistant_id')
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
        Schema::dropIfExists('projects');
    }
};
