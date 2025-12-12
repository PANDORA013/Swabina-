<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::factory()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
    }

    public function test_admin_can_update_faq()
    {
        $faq = Faq::create([
            'question' => 'Pertanyaan Lama',
            'answer' => 'Jawaban Lama',
            'kategori' => 'Umum'
        ]);

        $newData = [
            'question' => 'Pertanyaan Baru Update',
            'answer' => 'Jawaban Baru Update',
            'kategori' => 'Khusus',
        ];

        $response = $this->actingAs($this->adminUser)
                         ->put(route('admin.faq.update', $faq->id), $newData);

        $response->assertRedirect(route('admin.faq.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'question' => 'Pertanyaan Baru Update',
            'answer' => 'Jawaban Baru Update'
        ]);
    }

    public function test_admin_update_faq_validation_ignore_self()
    {
        $faq = Faq::create([
            'question' => 'Pertanyaan Sama',
            'answer' => 'Jawaban',
        ]);

        $response = $this->actingAs($this->adminUser)
                         ->put(route('admin.faq.update', $faq->id), [
                             'question' => 'Pertanyaan Sama',
                             'answer' => 'Jawaban Berubah',
                         ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('faqs', ['answer' => 'Jawaban Berubah']);
    }
}
