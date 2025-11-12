<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'module',
    ];

    /**
     * Get the roles that have this permission
     */
    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'role_permission');
    }

    /**
     * Group permissions by module
     */
    public static function groupedByModule()
    {
        return self::all()->groupBy('module');
    }

    /**
     * Get all permissions for a specific module
     */
    public static function forModule($module)
    {
        return self::where('module', $module)->get();
    }
}
