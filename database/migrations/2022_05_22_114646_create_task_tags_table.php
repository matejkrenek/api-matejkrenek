<?php

use App\Models\Kanban\KanbanTag;
use App\Models\Task\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KanbanTag::class, 'tag_id')->constrained('kanban_tags')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Task::class, 'task_id')->constrained('tasks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_tags');
    }
};
