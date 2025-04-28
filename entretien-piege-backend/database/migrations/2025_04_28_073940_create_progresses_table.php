<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('story_id')->constrained()->cascadeOnDelete();
            $table->foreignId('current_chapter_id')->constrained('chapters')->cascadeOnDelete();
            $table->json('choices_made')->nullable(); // stocker les choix sous forme JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progresses');
    }
};