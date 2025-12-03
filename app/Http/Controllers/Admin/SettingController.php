<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\SettingService;

class SettingController extends Controller
{
    /**
     * Display settings edit form
     */
    public function edit(SettingService $settings)
    {
        // Check authorization
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            abort(403, 'Unauthorized. Permission "manage-settings" required.');
        }

        // Get all settings data
        $data = [
            'socialLinks' => $settings->getSocialLinks(),
            'companyContact' => $settings->getCompanyContact(),
            'companyProfile' => $settings->getCompanyProfile(),
            'whyChooseUs' => $settings->getWhyChooseUs(),
            'jejakLangkahs' => $settings->getJejakLangkahs(),
            'layout' => $user->role === 'admin' ? 'layouts.app' : 'layouts.app-professional',
        ];

        return view('admin.settings.edit', $data);
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        // Check authorization
        $user = Auth::user();
        if (!$user->isSuperAdmin() && !$user->hasPermissionTo('manage-settings')) {
            return redirect()->back()->with('error', 'Unauthorized. Permission "manage-settings" required.');
        }

        try {
            // Validate input
            $validated = $request->validate([
                'contact_telepon' => 'nullable|string|max:20',
                'contact_email' => 'nullable|email',
                'contact_alamat' => 'nullable|string',
                'contact_jam_operasional' => 'nullable|string',
                'social_facebook' => 'nullable|url',
                'social_instagram' => 'nullable|url',
                'social_linkedin' => 'nullable|url',
                'social_youtube' => 'nullable|url',
                'social_whatsapp' => 'nullable|url',
                'profile_visi' => 'nullable|string',
                'profile_misi' => 'nullable|string',
                'profile_budaya' => 'nullable|string',
            ]);

            // --- 1. Update Social Links ---
            $socials = [
                'facebook' => $validated['social_facebook'] ?? '',
                'instagram' => $validated['social_instagram'] ?? '',
                'linkedin' => $validated['social_linkedin'] ?? '',
                'youtube' => $validated['social_youtube'] ?? '',
                'whatsapp' => $validated['social_whatsapp'] ?? '',
            ];
            DB::table('settings')->updateOrInsert(
                ['key' => 'social_links'],
                ['value' => json_encode($socials), 'updated_at' => now()]
            );

            // --- 2. Update Company Contact ---
            $contact = [
                'telepon' => $validated['contact_telepon'] ?? '',
                'email' => $validated['contact_email'] ?? '',
                'alamat' => $validated['contact_alamat'] ?? '',
                'jam_operasional' => $validated['contact_jam_operasional'] ?? '',
            ];
            DB::table('settings')->updateOrInsert(
                ['key' => 'company_contact'],
                ['value' => json_encode($contact), 'updated_at' => now()]
            );

            // --- 3. Update Company Profile (Visi, Misi, Budaya) ---
            $misiArray = array_filter(
                array_map('trim', explode("\n", $validated['profile_misi'] ?? ''))
            );
            $profile = [
                'visi' => $validated['profile_visi'] ?? '',
                'misi' => array_values($misiArray), // Re-index array
                'budaya' => $validated['profile_budaya'] ?? '',
            ];
            DB::table('settings')->updateOrInsert(
                ['key' => 'company_profile'],
                ['value' => json_encode($profile), 'updated_at' => now()]
            );

            // --- 4. REFRESH CACHE ---
            SettingService::refreshCache();

            return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
