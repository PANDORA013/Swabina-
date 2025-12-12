<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Faq;
use App\Models\LayananPage;
use App\Models\Sertifikat;
use App\Models\Berita;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()->create([
            'email' => 'admin_test@swabina.id',
            'password' => bcrypt('password'),
        ]);
    }

    private function checkModuleRoutes($moduleName, $routeName)
    {
        $responseIndex = $this->actingAs($this->adminUser)->get(route("admin.{$routeName}.index"));
        $responseIndex->assertStatus(200);

        $responseCreate = $this->actingAs($this->adminUser)->get(route("admin.{$routeName}.create"));
        $responseCreate->assertStatus(200);
    }

    public function test_admin_can_access_berita_module()
    {
        $this->checkModuleRoutes('Berita', 'berita');

        $data = Berita::create([
            'title' => 'Test Berita',
            'slug' => 'test-berita',
            'content' => 'Isi berita',
            'status' => 'published',
            'category' => 'Berita',
            'published_at' => now(),
        ]);
        
        $response = $this->actingAs($this->adminUser)->get(route('admin.berita.edit', $data->id));
        $response->assertStatus(200);
    }

    public function test_admin_can_access_faq_module()
    {
        $this->checkModuleRoutes('FAQ', 'faq');

        $data = Faq::create([
            'question' => 'Pertanyaan Test?',
            'answer' => 'Jawaban Test',
            'kategori' => 'Umum'
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.faq.edit', $data->id));
        $response->assertStatus(200);
    }

    public function test_admin_can_access_layanan_module()
    {
        $this->checkModuleRoutes('Layanan', 'layanan');

        $data = LayananPage::create([
            'slug' => 'layanan-test',
            'title' => 'Layanan Test',
            'subtitle' => 'Subtitle Test',
            'description' => 'Deskripsi Layanan',
            'is_active' => true,
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.layanan.edit', $data->slug));
        $response->assertStatus(200);
    }

    public function test_admin_can_access_sertifikat_module()
    {
        $this->checkModuleRoutes('Sertifikat', 'sertifikat');

        $data = Sertifikat::create([
            'title' => 'Sertifikat ISO',
            'description' => 'Sertifikat Kualitas',
            'issued_date' => now()
        ]);

        $response = $this->actingAs($this->adminUser)->get(route('admin.sertifikat.edit', $data->id));
        $response->assertStatus(200);
    }
}
