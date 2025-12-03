<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Rename Spatie permissions table to spatie_permissions
        if (Schema::hasTable('permissions')) {
            Schema::rename('permissions', 'spatie_permissions');
        }

        // Create custom permissions table
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('module')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
        
        // Restore Spatie permissions table
        if (Schema::hasTable('spatie_permissions')) {
            Schema::rename('spatie_permissions', 'permissions');
        }
    }
};
