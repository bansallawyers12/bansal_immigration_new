<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('postcode_ranges', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('start_postcode');
            $table->unsignedInteger('end_postcode');
            $table->string('category');
            $table->timestamps();

            $table->index(['start_postcode', 'end_postcode']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postcode_ranges');
    }
};


