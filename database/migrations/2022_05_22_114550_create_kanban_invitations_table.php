<?php

use App\Models\Kanban\Kanban;
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
        Schema::create('kanban_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kanban::class, 'kanban_id')->constrained('kanbans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(User::class, 'author_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(User::class, 'user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('token');
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
        Schema::dropIfExists('kanban_invitations');
    }
};
