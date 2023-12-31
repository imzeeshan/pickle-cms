<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\MediaFactory::new();
    }

    public function author()
    {
        return $this->hasOne('Modules\User\Entities\User', 'id', 'created_by');
    }
}
