<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Drop unused Spatie Permission tables
     * We use custom permission system (admin_roles, permissions, role_permission)
     * instead of Spatie Permission system
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Drop Spatie permission tables (not used)
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('roles');
        
        // Note: Keep Spatie 'permissions' table if it's referenced elsewhere
        // Otherwise drop it too, but we renamed it to 'spatie_permissions' earlier
        Schema::dropIfExists('spatie_permissions');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function down(): void
    {
        // Cannot restore dropped tables easily
        // This is a destructive migration
    }
};
