<?php

namespace App\Services;

/**
 * Inline Editor Service
 * Menyediakan helper untuk membuat inline editor dengan live preview
 * Mendukung berbagai tipe field (text, textarea, url, number, email)
 */
class InlineEditorService
{
    /**
     * Generate struktur untuk inline editing
     * 
     * @param string $modelName - Nama model (e.g., 'company-info', 'sekilas-perusahaan')
     * @param array $fields - Field yang bisa di-edit [
     *     'fieldName' => [
     *         'type' => 'text|textarea|url|number|email',
     *         'label' => 'Field Label',
     *         'validation' => 'required|string|max:255',
     *         'placeholder' => 'Optional placeholder',
     *         'rows' => 3 (untuk textarea)
     *     ]
     * ]
     * @param string $routePrefix - Prefix route untuk update (e.g., 'admin.company-info')
     * @return array
     */
    public static function generateConfig($modelName, $fields, $routePrefix)
    {
        return [
            'modelName' => $modelName,
            'fields' => $fields,
            'routePrefix' => $routePrefix,
            'endpoints' => [
                'update' => route("{$routePrefix}.update", [], false),
            ]
        ];
    }

    /**
     * Generate HTML untuk inline edit button + preview
     */
    public static function editableField($fieldName, $value, $fieldConfig, $modelId = 1)
    {
        $fieldType = $fieldConfig['type'] ?? 'text';
        $label = $fieldConfig['label'] ?? $fieldName;
        $placeholder = $fieldConfig['placeholder'] ?? '';
        
        return [
            'fieldName' => $fieldName,
            'type' => $fieldType,
            'label' => $label,
            'value' => $value,
            'placeholder' => $placeholder,
            'modelId' => $modelId,
            'htmlId' => "field-{$fieldName}",
            'btnId' => "edit-{$fieldName}",
        ];
    }

    /**
     * Validasi field berdasarkan config
     */
    public static function validateField($fieldName, $value, $fieldConfig)
    {
        $rules = $fieldConfig['validation'] ?? 'required|string';
        
        // Return array untuk Laravel validation
        return [
            $fieldName => $rules
        ];
    }

    /**
     * Handle inline update
     * Digunakan di controller untuk process update inline
     */
    public static function handleInlineUpdate($model, $fieldName, $value, $fieldConfig)
    {
        // Validate
        $validator = validator(
            [$fieldName => $value],
            self::validateField($fieldName, $value, $fieldConfig)
        );

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => $validator->errors()->first($fieldName)
            ];
        }

        // Update model
        try {
            $model->update([$fieldName => $value]);
            
            return [
                'success' => true,
                'message' => 'Field updated successfully',
                'data' => [
                    'fieldName' => $fieldName,
                    'value' => $value
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error updating field: ' . $e->getMessage()
            ];
        }
    }
}
