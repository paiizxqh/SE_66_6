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
            $table->increments('requisition_id');

            $table->unsignedInteger('set_id');
            $table->foreign('set_id')
                ->references('set_id')
                ->on('product_set')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');

            $table->unsignedInteger('sample_id');
            $table->foreign('sample_id')
                ->references('sample_id')
                ->on('parameter_in_checkpoints')
                ->onUpdate('cascade')
                ->onDelete('NO ACTION');

            $table->string('requisition_remark',200);
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
