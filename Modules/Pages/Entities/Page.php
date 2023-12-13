<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Page extends Model
{
    use HasFactory;

    use Searchable;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Pages\Database\factories\PageFactory::new();
    }

    public function author()
    {
        return $this->hasOne('Modules\User\Entities\User', 'id', 'created_by');
    }


    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

    
}
