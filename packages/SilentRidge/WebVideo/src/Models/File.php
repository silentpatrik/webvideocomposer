<?php

namespace WebVideo\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
