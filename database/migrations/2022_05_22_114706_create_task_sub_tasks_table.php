<?php

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
        Schema::create('task_sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Task::class, 'task_id')->constrained('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 100);
            $table->boolean('is_completed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_sub_tasks');
    }
};
