<?php

use App\Models\Kanban\KanbanColumn;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KanbanColumn::class, 'column_id')->constrained('kanban_columns')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignIdFor(User::class, 'author_id')->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignIdFor(User::class, 'executor_id')->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('row');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
