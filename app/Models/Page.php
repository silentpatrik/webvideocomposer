<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'slug'];

    protected $searchableFields = ['*'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /*public function sections()
    {
        return $this->belongsToMany(Section::class);
    }*/
}
