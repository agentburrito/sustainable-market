<?php

namespace App\Models;

use App\Models\Listing;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent() 
    {
        return $this->belongsTo(Category::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

}
