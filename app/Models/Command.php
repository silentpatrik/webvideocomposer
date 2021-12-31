<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Command extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'executable',
        'title',
        'parallel',
        'enabled',
        'render_pipeline_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function arguments()
    {
        return $this->hasMany(Argument::class);
    }

    public function renderPipeline()
    {
        return $this->belongsTo(RenderPipeline::class);
    }

    public function renderPipelines()
    {
        return $this->belongsToMany(RenderPipeline::class);
    }
}
