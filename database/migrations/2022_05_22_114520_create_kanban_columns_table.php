<?php

use App\Models\Kanban\Kanban;
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
        Schema::create('kanban_columns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kanban::class, 'kanban_id')->constrained('kanbans')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 100);
            $table->string('color')->nullable();
            $table->integer('order');
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
        Schema::dropIfExists('kanban_columns');
    }
};
