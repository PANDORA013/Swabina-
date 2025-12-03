<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
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
    public $timestamps = true;
}
