<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
