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
        // Home Content table
        Schema::create('home_content', function (Blueprint $table) {
            $table->id();
            $table->string('meta_key')->unique();
            $table->text('meta_value')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        // Sliders table
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('image');
            $table->string('image_alt')->nullable();
            $table->string('link')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Blogs table
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description');
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->string('author')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Services table
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description');
            $table->longText('description');
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('icon')->nullable();
            $table->string('category')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Pages table
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->string('template')->nullable();
            $table->string('category');
            $table->string('subcategory')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->integer('order')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('set null');
            $table->index(['category', 'status']);
            $table->index(['category', 'subcategory', 'status']);
        });

        // Appointments table
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('service_type')->nullable();
            $table->text('message')->nullable();
            $table->datetime('preferred_date')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, cancelled, completed
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Contact inquiries table
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('new'); // new, read, replied, closed
            $table->text('response')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });

        // Testimonials table
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('visa_type');
            $table->text('testimonial');
            $table->integer('rating')->default(5);
            $table->string('client_image')->nullable();
            $table->string('location')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('contact_inquiries');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('services');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('home_content');
    }
};