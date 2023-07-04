<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title', 255);
            $table->unsignedInteger('order');
            $table->string('video', 255)->nullable();
            $table->string('sound', 255)->nullable();
            $table->string('file', 255)->nullable();
            $table->boolean('has_test');
            $table->unsignedSmallInteger('passing_mark')->default(80);
            $table->timestamps();

            $table->unique(['course_id', 'order']);
            //TODO: check for order is unique for each course
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
