<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 * Trait untuk menyediakan fungsionalitas inline editor di controller
 * 
 * Contoh penggunaan di controller:
 * 
 * class CompanyInfoController extends Controller {
 *     use HasInlineEditor;
 *     
 *     protected $editableFields = [
 *         'company_name' => 'required|string|max:255',
 *         'company_tagline' => 'required|string|max:500',
 *         'company_description' => 'required|string',
 *         'email_primary' => 'required|email',
 *     ];
 * }
 */
trait HasInlineEditor
{
    /**
     * Handle inline field update
     * Route: POST /resource/inline-update
     */
    public function inlineUpdate(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        // Get model class dari controller property atau dari namespace
        $modelClass = $this->getModelClass();
        if (!$modelClass) {
            return response()->json([
                'success' => false,
                'message' => 'Model class not found'
            ], 400);
        }

        // Get editable fields dari controller property
        $editableFields = $this->editableFields ?? [];
        if (!isset($editableFields[$field])) {
            return response()->json([
                'success' => false,
                'message' => 'Field tidak dapat diedit'
            ], 400);
        }

        // Validate
        $validator = validator(
            [$field => $value],
            [$field => $editableFields[$field]]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first($field)
            ], 422);
        }

        try {
            // Get model instance (default id=1 for singleton models like CompanyInfo)
            $id = $request->input('id', 1);
            $model = $modelClass::findOrFail($id);

            // Check permission if method exists
            if (method_exists($this, 'authorizeUpdate')) {
                $this->authorizeUpdate($model, $field);
            }

            // Update field
            $model->update([$field => $value]);

            // Clear cache if method exists
            if (method_exists($modelClass, 'clearCache')) {
                $modelClass::clearCache();
            }

            return response()->json([
                'success' => true,
                'message' => 'Field berhasil diperbarui',
                'data' => [
                    'field' => $field,
                    'value' => $value
                ]
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Record tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ambil model class dari namespace atau property
     */
    protected function getModelClass()
    {
        // Method 1: Cek property di controller
        if (property_exists($this, 'model')) {
            return $this->model;
        }

        // Method 2: Derive dari controller namespace
        $controllerName = class_basename($this);
        $controllerName = str_replace('Controller', '', $controllerName);

        // Common model mappings
        $mappings = [
            'CompanyInfo' => 'App\Models\CompanyInfo',
            'Berita' => 'App\Models\Berita',
            'FAQ' => 'App\Models\Faq',
            'Pedoman' => 'App\Models\Pedoman',
            'Sertifikat' => 'App\Models\Sertifikat',
            'VisiMisiBudaya' => 'App\Models\VisiMisiBudaya',
            'SekilasPerusahaan' => 'App\Models\SekilasPerusahaan',
            'WhyChooseUs' => 'App\Models\WhyChooseUs',
        ];

        $modelClass = $mappings[$controllerName] ?? "App\Models\\{$controllerName}";

        return class_exists($modelClass) ? $modelClass : null;
    }
}
