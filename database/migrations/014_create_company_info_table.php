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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            
            // Company Identity
            $table->string('company_name')->default('PT Swabina Gatra');
            $table->text('company_tagline')->nullable();
            $table->text('company_description')->nullable();
            $table->string('company_logo')->nullable();
            
            // Head Office
            $table->text('head_office_address');
            $table->string('head_office_city');
            $table->string('head_office_province');
            $table->string('head_office_postal_code');
            
            // Branch Office
            $table->text('branch_office_address')->nullable();
            $table->string('branch_office_city')->nullable();
            $table->string('branch_office_province')->nullable();
            $table->string('branch_office_postal_code')->nullable();
            
            // Contact Info
            $table->string('email_primary');
            $table->string('email_secondary')->nullable();
            $table->string('phone_primary');
            $table->string('phone_secondary')->nullable();
            $table->string('branch_phone_primary')->nullable();
            $table->string('branch_phone_secondary')->nullable();
            
            // Operating Hours (JSON)
            $table->json('operating_hours_weekday')->nullable();
            $table->json('operating_hours_weekend')->nullable();
            
            // ISO Logos
            $table->string('iso_logo_1')->nullable();
            $table->string('iso_logo_2')->nullable();
            $table->string('iso_logo_3')->nullable();
            $table->string('iso_logo_4')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
