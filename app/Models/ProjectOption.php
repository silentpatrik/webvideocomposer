<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectOption extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'project_id',
        'title',
        'value',
        'settings',
        'description',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'project_options';

    protected $casts = [
        'settings' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
