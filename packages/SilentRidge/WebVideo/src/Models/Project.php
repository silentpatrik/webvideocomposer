<?php

namespace WebVideo\Models;

use App\Models\Scopes\Searchable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'description', 'user_id'];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(ProjectOption::class);
    }

    public function renderPipelines()
    {
        return $this->belongsToMany(RenderPipeline::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
