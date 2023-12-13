<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;

    use Searchable;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Posts\Database\factories\PostFactory::new();
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

}
