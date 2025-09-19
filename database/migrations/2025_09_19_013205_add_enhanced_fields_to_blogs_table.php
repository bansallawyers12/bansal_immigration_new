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
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_category')->nullable()->after('slug');
            $table->string('pdf_doc')->nullable()->after('image_alt');
            $table->text('youtube_url')->nullable()->after('pdf_doc');
            
            // Add foreign key constraint for category
            $table->foreign('parent_category')->references('id')->on('blog_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['parent_category']);
            $table->dropColumn(['parent_category', 'pdf_doc', 'youtube_url']);
        });
    }
};
