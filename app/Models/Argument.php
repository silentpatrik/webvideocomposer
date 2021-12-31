<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Argument extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'value',
        'description',
        'command_id',
        'enabled',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function command()
    {
        return $this->belongsTo(Command::class);
    }
}
