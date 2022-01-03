<?php

namespace WebVideo\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenderPipeline extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'render_pipelines';

    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function commands()
    {
        return $this->belongsToMany(Command::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
