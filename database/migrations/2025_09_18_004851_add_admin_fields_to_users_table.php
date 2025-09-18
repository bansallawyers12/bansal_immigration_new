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
        Schema::table('users', function (Blueprint $table) {
            // Admin profile fields
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('company_name')->nullable()->after('phone');
            $table->string('company_website')->nullable()->after('company_name');
            $table->string('company_fax', 20)->nullable()->after('company_website');
            $table->integer('country')->nullable()->after('company_fax');
            $table->integer('state')->nullable()->after('country');
            $table->string('city', 100)->nullable()->after('state');
            $table->text('address')->nullable()->after('city');
            $table->string('zip', 20)->nullable()->after('address');
            $table->string('profile_img')->nullable()->after('zip');
            
            // Admin status fields
            $table->tinyInteger('status')->default(1)->after('profile_img');
            $table->tinyInteger('is_archived')->default(0)->after('status');
            $table->date('archived_on')->nullable()->after('is_archived');
            $table->string('client_id')->nullable()->after('archived_on');
            
            // Role field to distinguish admin vs regular users (if needed in future)
            $table->string('role')->default('admin')->after('client_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'company_name', 'company_website', 'company_fax',
                'country', 'state', 'city', 'address', 'zip', 'profile_img',
                'status', 'is_archived', 'archived_on', 'client_id', 'role'
            ]);
        });
    }
};