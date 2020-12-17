<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    protected static function booted()
    {
        static::addGlobalScope('orderScope', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent');
    }

    public function scopeHasChildren()
    {
        return $this->children->count() > 0 ? true : false;
    }

    public function scopeHasParent()
    {
        return $this->parent()->count() > 0 ? true : false;
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent');
    }
}
