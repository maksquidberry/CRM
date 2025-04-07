<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('poster_id');
            $table->string('code')->nullable();

            $table->boolean('get_user')->default(false)->nullable();
            $table->enum('status', ['create', 'new','cooking','packing', 'complete', 'close'])->default('create')->nullable();

            $table->float('total_price')->nullable();
            $table->integer('total_amount')->nullable();

            $table->timestamp('start_order')->useCurrent();

            $table->integer('cooking_id')->nullable();
            $table->timestamp('start_cook_order')->nullable();
            $table->timestamp('end_cook_order')->nullable();
            $table->integer('cook_seconds')->default(0)->nullable();

            $table->integer('packing_id')->nullable();
            $table->timestamp('start_pack_order')->nullable();
            $table->timestamp('end_pack_order')->nullable();
            $table->integer('pack_seconds')->default(0)->nullable();

            $table->timestamp('close_order')->nullable();
            $table->integer('close_sec')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
