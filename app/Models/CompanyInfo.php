<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $table = 'company_info';

    protected $fillable = [
        'company_name',
        'company_tagline',
        'company_description',
        'company_logo',
        'head_office_address',
        'head_office_city',
        'head_office_province',
        'head_office_postal_code',
        'branch_office_address',
        'branch_office_city',
        'branch_office_province',
        'branch_office_postal_code',
        'email_primary',
        'email_secondary',
        'phone_primary',
        'phone_secondary',
        'branch_phone_primary',
        'branch_phone_secondary',
        'operating_hours_weekday',
        'operating_hours_weekend',
        'iso_logo_1',
        'iso_logo_2',
        'iso_logo_3',
        'iso_logo_4',
    ];

    protected $casts = [
        'operating_hours_weekday' => 'array',
        'operating_hours_weekend' => 'array',
    ];

    /**
     * Get the company info instance (singleton pattern)
     * Always returns the first (and only) record
     */
    public static function getInstance()
    {
        return static::first() ?? static::create([
            'company_name' => 'PT Swabina Gatra',
            'company_tagline' => 'Leading Facility Management & Services',
            'company_description' => 'Leading Facility Management & Services provider di Indonesia dengan komitmen memberikan layanan terbaik untuk kebutuhan bisnis Anda.',
            'head_office_address' => 'Jl. R.A. Kartini No.21 A',
            'head_office_city' => 'Gresik',
            'head_office_province' => 'Jawa Timur',
            'head_office_postal_code' => '61122',
            'email_primary' => 'marketing@swabina.id',
            'email_secondary' => 'info@swabinagatra.co.id',
            'phone_primary' => '+62 31 3984719',
            'phone_secondary' => '+62 31 3985794',
            'operating_hours_weekday' => [
                'days' => 'Senin - Jumat',
                'from' => '08:00',
                'to' => '17:00',
                'timezone' => 'WIB'
            ],
            'operating_hours_weekend' => [
                'days' => 'Sabtu',
                'from' => '08:00',
                'to' => '12:00',
                'timezone' => 'WIB'
            ],
        ]);
    }
}
