<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialLink;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\DB;

class ManualDataSeeder extends Seeder
{
    /**
     * Seed manual data untuk Social Media dan Company Info
     */
    public function run(): void
    {
        echo "🚀 Starting Manual Data Input...\n\n";

        // 1. INPUT SOCIAL MEDIA LINKS
        echo "📱 Inputting Social Media Links...\n";
        
        $socialData = [
            'id' => 1,
            'facebook' => 'https://www.facebook.com/ptswabinagatra',
            'youtube' => 'https://www.youtube.com/@PTSwabinaGatra',
            'youtube_landing' => 'https://www.youtube.com/@PTSwabinaGatra',
            'whatsapp' => 'https://wa.me/6281234567890',
            'instagram' => 'https://www.instagram.com/ptswabinagatra',
            'linkedin' => 'https://www.linkedin.com/company/pt-swabina-gatra',
        ];

        SocialLink::updateOrCreate(
            ['id' => 1],
            $socialData
        );

        echo "   ✅ Facebook: " . $socialData['facebook'] . "\n";
        echo "   ✅ YouTube: " . $socialData['youtube'] . "\n";
        echo "   ✅ WhatsApp: " . $socialData['whatsapp'] . "\n";
        echo "   ✅ Instagram: " . $socialData['instagram'] . "\n";
        echo "   ✅ LinkedIn: " . $socialData['linkedin'] . "\n\n";

        // 2. INPUT COMPANY INFO
        echo "🏢 Inputting Company Information...\n";
        
        $companyData = [
            'id' => 1,
            
            // Company Identity
            'company_name' => 'PT Swabina Gatra',
            'company_tagline' => 'Professional Facility Management & Integrated Services',
            'company_description' => 'PT Swabina Gatra adalah perusahaan yang bergerak di bidang Facility Management, Security Services, Cleaning Services, dan berbagai layanan terintegrasi lainnya. Dengan pengalaman lebih dari 20 tahun, kami berkomitmen memberikan pelayanan terbaik untuk klien kami.',
            
            // Head Office
            'head_office_address' => 'Jl. R.A. Kartini No.21 A',
            'head_office_city' => 'Gresik',
            'head_office_province' => 'Jawa Timur',
            'head_office_postal_code' => '61122',
            
            // Branch Office
            'branch_office_address' => 'Gedung Graha Pena Lt. 15, Jl. Ahmad Yani No. 88',
            'branch_office_city' => 'Surabaya',
            'branch_office_province' => 'Jawa Timur',
            'branch_office_postal_code' => '60234',
            
            // Contact Info
            'email_primary' => 'marketing@swabina.id',
            'email_secondary' => 'info@swabina.id',
            'phone_primary' => '+62 31 3984719',
            'phone_secondary' => '+62 31 3984720',
            'branch_phone_primary' => '+62 31 8271234',
            'branch_phone_secondary' => '+62 31 8271235',
            
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
        ];

        CompanyInfo::updateOrCreate(
            ['id' => 1],
            $companyData
        );

        echo "   ✅ Company Name: " . $companyData['company_name'] . "\n";
        echo "   ✅ Tagline: " . $companyData['company_tagline'] . "\n";
        echo "   ✅ Head Office: " . $companyData['head_office_address'] . ", " . $companyData['head_office_city'] . "\n";
        echo "   ✅ Branch Office: " . $companyData['branch_office_address'] . ", " . $companyData['branch_office_city'] . "\n";
        echo "   ✅ Email: " . $companyData['email_primary'] . "\n";
        echo "   ✅ Phone: " . $companyData['phone_primary'] . "\n";
        echo "   ✅ Operating Hours: " . json_decode($companyData['operating_hours_weekday'])->days . " " . json_decode($companyData['operating_hours_weekday'])->from . "-" . json_decode($companyData['operating_hours_weekday'])->to . "\n\n";

        // 3. SUMMARY
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "✅ MANUAL DATA INPUT COMPLETE!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        
        echo "📊 Summary:\n";
        echo "   • Social Media Links: 6 platforms\n";
        echo "   • Company Information: Complete\n";
        echo "   • Head Office: Gresik\n";
        echo "   • Branch Office: Surabaya\n";
        echo "   • Contact: 2 emails, 4 phones\n\n";
        
        echo "🎯 Next Steps:\n";
        echo "   1. Login to admin panel\n";
        echo "   2. Navigate to 'PENGATURAN WEBSITE' → 'Informasi Perusahaan'\n";
        echo "   3. Upload company logo & ISO logos\n";
        echo "   4. Verify all data on public website\n\n";
        
        echo "🚀 All data successfully inserted into database!\n";
    }
}
