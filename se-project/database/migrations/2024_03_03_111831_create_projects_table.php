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
            $table->id();
            $table->string('project_id')->unique();
            $table->date('start_date');
            $table->date('area_date');
            $table->string('map');
            $table->string('customers_contact_name');
            $table->string('customers_contact_phone');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')
                    ->references('id')
                    ->on('project_status')
                    ->onUpdate('cascade')
                    ->onDelete('NO ACTION');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                        ->references('id')
                        ->on('customers')
                        ->onUpdate('cascade')
                        ->onDelete('NO ACTION');

            $table->unsignedBigInteger('assistant_id');
            $table->foreign('assistant_id')
                    ->references('id')
                    ->on('users')
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
