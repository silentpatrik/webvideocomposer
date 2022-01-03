<?php

namespace WebVideo\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
