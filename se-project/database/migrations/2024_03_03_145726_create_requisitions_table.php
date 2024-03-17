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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_set_id');
            $table->foreign('product_set_id')
                ->references('id')
                ->on('product_set')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');

            $table->unsignedBigInteger('sample_id');
            $table->foreign('sample_id')
                ->references('id')
                ->on('parameter_in_checkpoints')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');

            $table->string('requisition_remark');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
