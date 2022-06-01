<?php

namespace App\Models\Kanban;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KanbanInvitation extends Model
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
        'author_id',
        'user_id',
        'token',
    ];

    /**
     * Relationships
     */
    public function kanban()
    {
        return $this->belongsTo(Kanban::class, 'kanban_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
