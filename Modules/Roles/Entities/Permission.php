<?php

namespace Modules\Roles\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $table = "permissions";

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Roles\Database\factories\PermissionFactory::new();
    }

    public function role()
    {
        return
            $this->belongsTo('Modules\Roles\Entities\Role');
    }
}
