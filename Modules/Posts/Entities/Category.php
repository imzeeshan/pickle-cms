<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [];

    public $sortable = ['id', 'name'];

    protected static function newFactory()
    {
        return \Modules\Posts\Database\factories\CategoryFactory::new();
    }
}
