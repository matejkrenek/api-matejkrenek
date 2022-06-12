<?php

namespace App\Models\Kanban;

use App\Models\Task\Task;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kanban extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author_id',
        'name',
        'description',
    ];

    /**
     * Relationships
     */
    public function columns()
    {
        return $this->hasMany(KanbanColumn::class, 'kanban_id');
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, KanbanColumn::class, 'kanban_id', 'column_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'user_kanbans', 'kanban_id', 'user_id');
    }
}
