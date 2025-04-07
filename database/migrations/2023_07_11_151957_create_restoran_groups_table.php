<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('restoran_groups', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('xml_id');
            $table->string('description')->nullable();
            $table->foreignIdFor(\App\Models\Restorans::class, 'group_item');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restoran_groups');
    }
};
