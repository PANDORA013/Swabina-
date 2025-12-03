<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop the JSON check constraints that are preventing string inserts
        // We need to modify the columns to remove the CHECK constraints
        
        DB::statement('ALTER TABLE beritas MODIFY COLUMN title longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL');
        DB::statement('ALTER TABLE beritas MODIFY COLUMN description longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL');
    }

    public function down(): void
    {
        // Restore the constraints if needed
        DB::statement('ALTER TABLE beritas MODIFY COLUMN title longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`title`))');
        DB::statement('ALTER TABLE beritas MODIFY COLUMN description longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`))');
    }
};
