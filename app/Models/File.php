<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['fileable_id', 'fileable_type'];

    protected $searchableFields = ['*'];

    public function fileable()
    {
        return $this->morphTo();
    }
}
