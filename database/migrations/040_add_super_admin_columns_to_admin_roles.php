<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Menambahkan kolom is_super_admin dan is_active ke tabel admin_roles
     * untuk mendukung sistem Super Admin dengan akses mutlak
     */
    public function up()
    {
        Schema::table('admin_roles', function (Blueprint $table) {
            // Tambahkan kolom is_super_admin (flag untuk akses mutlak)
            if (!Schema::hasColumn('admin_roles', 'is_super_admin')) {
                $table->boolean('is_super_admin')->default(false)->after('description');
            }
            
            // Tambahkan kolom is_active (status role aktif/tidak)
            if (!Schema::hasColumn('admin_roles', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_super_admin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('admin_roles', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan jika rollback
            if (Schema::hasColumn('admin_roles', 'is_active')) {
                $table->dropColumn('is_active');
            }
            
            if (Schema::hasColumn('admin_roles', 'is_super_admin')) {
                $table->dropColumn('is_super_admin');
            }
        });
    }
};
