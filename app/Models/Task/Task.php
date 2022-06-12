<?php

namespace App\Models\Task;

use App\Models\Kanban\KanbanColumn;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'column_id',
        'author_id',
        'executor_id',
        'row',
        'name',
        'description',
        'is_completed'
    ];

    /**
     * Relationships
     */
    public function column()
    {
        return $this->belongsTo(KanbanColumn::class, 'column_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function executor()
    {
        return $this->belongsTo(User::class, 'executor_id');
    }
}
