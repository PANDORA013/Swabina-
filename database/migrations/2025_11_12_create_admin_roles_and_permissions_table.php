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
        // Create admin_roles table
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // super_admin, admin, moderator
            $table->string('display_name'); // Super Admin, Admin, Moderator
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // manage_berita, manage_faq, etc
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->string('module'); // berita, faq, pedoman, etc
            $table->timestamps();
        });

        // Create role_permission pivot table
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_role_id')->constrained('admin_roles')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['admin_role_id', 'permission_id']);
        });

        // Add admin_role_id to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('admin_role_id')->nullable()->constrained('admin_roles')->onDelete('set null');
            $table->text('permissions_json')->nullable(); // Store custom permissions as JSON
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeignIdFor('admin_roles');
            $table->dropColumn('permissions_json');
        });

        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('admin_roles');
    }
};
