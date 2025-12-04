<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\LayananPage;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of all services
     */
    public function index()
    {
        $companyInfo = CompanyInfo::first();
        $services = LayananPage::getActive();
        
        return view('layanan.index', compact('companyInfo', 'services'));
    }

    /**
     * Display the specified service by slug (Dynamic with Fallback)
     */
    public function show($slug)
    {
        $companyInfo = CompanyInfo::first();
        
        try {
            $service = LayananPage::findBySlug($slug);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Fallback: Create dummy data if not found in database
            $service = $this->getFallbackService($slug);
            
            // If fallback also returns null, show 404
            if (!$service) {
                abort(404, "Layanan dengan slug '$slug' tidak ditemukan. Silakan tambahkan di Admin Panel.");
            }
        }
        
        // Get related services (for "Other Services" section)
        $relatedServices = LayananPage::where('is_active', true)
            ->where('slug', '!=', $slug)
            ->orderBy('order')
            ->limit(3)
            ->get();
        
        return view('layanan.show', compact('companyInfo', 'service', 'relatedServices'));
    }
    
    /**
     * Get fallback/dummy data for services not yet in database
     */
    private function getFallbackService($slug)
    {
        $fallbackData = [
            'swa-academy' => [
                'slug' => 'swa-academy',
                'title' => 'SWA Academy',
                'description' => 'Pusat pengembangan kompetensi dan pelatihan profesional untuk meningkatkan kualitas SDM Anda.',
                'content' => '<h3>Tentang SWA Academy</h3><p>SWA Academy adalah divisi pelatihan dan pengembangan SDM dari PT Swabina Gatra yang berfokus pada peningkatan kompetensi profesional di berbagai bidang industri.</p><h4>Program Pelatihan</h4><ul><li>Leadership & Management Training</li><li>Technical Skills Development</li><li>Soft Skills Enhancement</li><li>Professional Certification Programs</li></ul><h4>Keunggulan</h4><ul><li>Instruktur bersertifikat dan berpengalaman</li><li>Materi training up-to-date dengan standar industri</li><li>Sertifikat resmi yang diakui</li><li>Metode pembelajaran interaktif</li></ul>',
                'image' => null,
                'icon' => 'bi-mortarboard',
                'is_active' => true,
                'order' => 1,
            ],
            'facility-management' => [
                'slug' => 'facility-management',
                'title' => 'Facility Management',
                'description' => 'Layanan pengelolaan fasilitas profesional yang komprehensif untuk gedung dan perkantoran.',
                'content' => '<h3>Tentang Facility Management</h3><p>Layanan pengelolaan dan pemeliharaan fasilitas gedung secara profesional, mencakup cleaning service, security, maintenance, dan layanan pendukung lainnya.</p><h4>Layanan Kami</h4><ul><li>Cleaning Service & Housekeeping</li><li>Security & Access Control</li><li>Building Maintenance</li><li>Landscaping & Gardening</li><li>Waste Management</li></ul><h4>Keunggulan</h4><ul><li>Tim profesional terlatih dengan sertifikasi</li><li>Sistem monitoring 24/7</li><li>Peralatan modern dan standar</li><li>SOP yang jelas dan terukur</li></ul>',
                'image' => null,
                'icon' => 'bi-building-gear',
                'is_active' => true,
                'order' => 2,
            ],
            'digital-solution' => [
                'slug' => 'digital-solution',
                'title' => 'Digital Solution',
                'description' => 'Solusi teknologi digital inovatif dan transformasi sistem untuk efisiensi bisnis Anda.',
                'content' => '<h3>Tentang Digital Solution</h3><p>Kami menyediakan solusi teknologi digital yang inovatif untuk mendukung transformasi digital perusahaan Anda, mulai dari pengembangan sistem hingga konsultasi IT.</p><h4>Layanan Digital</h4><ul><li>Enterprise Resource Planning (ERP)</li><li>Human Resource Information System (HRIS)</li><li>Website & Mobile App Development</li><li>IT Infrastructure Setup</li><li>Digital Transformation Consulting</li></ul><h4>Teknologi yang Digunakan</h4><ul><li>Cloud Computing (AWS, Google Cloud)</li><li>Modern Programming Languages (PHP, Python, JavaScript)</li><li>Database Management (MySQL, PostgreSQL)</li><li>Mobile Development (React Native, Flutter)</li></ul>',
                'image' => null,
                'icon' => 'bi-cpu',
                'is_active' => true,
                'order' => 3,
            ],
            'swa-tour-organizer' => [
                'slug' => 'swa-tour-organizer',
                'title' => 'SWA Tour Organizer',
                'description' => 'Penyedia jasa perjalanan wisata dan event organizer terpercaya untuk pengalaman tak terlupakan.',
                'content' => '<h3>Tentang SWA Tour Organizer</h3><p>SWA Tour adalah divisi travel dan event organizer yang menyediakan layanan perjalanan wisata domestik dan internasional, serta penyelenggaraan event corporate.</p><h4>Layanan Kami</h4><ul><li>Paket Wisata Domestik & Internasional</li><li>Corporate Gathering & Team Building</li><li>MICE (Meeting, Incentive, Convention, Exhibition)</li><li>Umroh & Haji</li><li>Ticketing & Hotel Reservation</li></ul><h4>Keunggulan</h4><ul><li>Tour guide profesional dan berpengalaman</li><li>Harga kompetitif dengan fasilitas terbaik</li><li>Armada transportasi modern dan nyaman</li><li>Itinerary yang fleksibel sesuai kebutuhan</li><li>Asuransi perjalanan tersedia</li></ul>',
                'image' => null,
                'icon' => 'bi-airplane',
                'is_active' => true,
                'order' => 4,
            ],
            'swasegar-amdk' => [
                'slug' => 'swasegar-amdk',
                'title' => 'Swasegar AMDK',
                'description' => 'Air Minum Dalam Kemasan (AMDK) yang higienis, segar, dan berkualitas tinggi.',
                'content' => '<h3>Tentang Swasegar AMDK</h3><p>Swasegar adalah brand Air Minum Dalam Kemasan (AMDK) dari PT Swabina Gatra yang mengutamakan kualitas, kesegaran, dan higienis dalam setiap produknya.</p><h4>Produk Kami</h4><ul><li>Swasegar Cup 240ml - Praktis untuk sekali minum</li><li>Swasegar Botol 600ml - Ideal untuk aktivitas sehari-hari</li><li>Swasegar Gallon 19L - Ekonomis untuk kebutuhan rumah tangga dan kantor</li></ul><h4>Keunggulan Produk</h4><ul><li>Sumber air dari mata air pegunungan yang terjaga</li><li>Proses produksi higienis dengan standar BPOM</li><li>Kemasan food grade yang aman</li><li>Harga terjangkau dengan kualitas terjamin</li><li>Distribusi cepat dan tepat waktu</li></ul><h4>Sertifikasi</h4><ul><li>BPOM - Badan Pengawas Obat dan Makanan</li><li>Halal MUI</li><li>ISO 9001:2015 Quality Management System</li></ul>',
                'image' => null,
                'icon' => 'bi-cup-straw',
                'is_active' => true,
                'order' => 5,
            ],
        ];
        
        // Return dummy data as object if slug exists in fallback
        if (isset($fallbackData[$slug])) {
            return (object) $fallbackData[$slug];
        }
        
        return null;
    }
}
