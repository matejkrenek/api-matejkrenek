<?php

use App\Models\Task\Task;
use App\Models\User\User;
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
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Task::class, 'task_id')->constrained('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(User::class, 'author_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('text');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_comments');
    }
};
