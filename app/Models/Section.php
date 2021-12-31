<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'content', 'page_id'];

    protected $searchableFields = ['*'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }
}
