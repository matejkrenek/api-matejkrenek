<?php

namespace App\Models\Kanban;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KanbanColumn extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kanban_id',
        'name',
        'color',
        'order',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'column_id');
    }
}
