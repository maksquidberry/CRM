<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->float('price')->nullable();
            $table->integer('amount')->nullable();

            $table->integer('order_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders_items');
    }
};
