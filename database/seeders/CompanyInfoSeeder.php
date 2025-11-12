<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    public function run()
    {
        CompanyInfo::updateOrCreate(
            ['id' => 1],
            [
                'company_name' => 'PT Swabina Gatra',
                'company_tagline' => 'Leading Facility Management & Services',
                'company_description' => 'PT Swabina Gatra adalah penyedia layanan Facility Management & Services terkemuka di Indonesia dengan komitmen memberikan layanan terbaik untuk kebutuhan bisnis Anda.',
                
                // Head Office
                'head_office_address' => 'Jl. R.A. Kartini No.21 A',
                'head_office_city' => 'Gresik',
                'head_office_province' => 'Jawa Timur',
                'head_office_postal_code' => '61122',
                
                // Branch Office
                'branch_office_address' => 'Desa Sumberarum, Kecamatan Kerek',
                'branch_office_city' => 'Tuban',
                'branch_office_province' => 'Jawa Timur',
                'branch_office_postal_code' => '62356',
                
                // Contact Info
                'email_primary' => 'marketing@swabina.id',
                'email_secondary' => 'info@swabinagatra.co.id',
                'phone_primary' => '+62 31 3984719',
                'phone_secondary' => '+62 31 3985794',
                'branch_phone_primary' => '+62 356 711992',
                'branch_phone_secondary' => '+62 356 711966',
                
                // Operating Hours
                'operating_hours_weekday' => json_encode([
                    'days' => 'Senin - Jumat',
                    'from' => '08:00',
                    'to' => '17:00',
                    'timezone' => 'WIB'
                ]),
                'operating_hours_weekend' => json_encode([
                    'days' => 'Sabtu',
                    'from' => '08:00',
                    'to' => '12:00',
                    'timezone' => 'WIB'
                ]),
            ]
        );
        
        $this->command->info('✅ Company Info seeded successfully!');
    }
}
