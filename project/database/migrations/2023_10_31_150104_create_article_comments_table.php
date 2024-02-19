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
        Schema::create('article_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('comment');
            $table->integer('like_count')->default(0);
            $table->integer('dislike_count')->default(0);
            $table->string('user_full_name')->nullable();
            $table->string('user_email')->nullable();
            $table->ipAddress();
            $table->string('user_agent')->nullable();
            $table->boolean('approve_status')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->softDeletes(); // deleted_at
            $table->foreign('article_id')->on('articles')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('parent_id')->on('article_comments')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_comments');
    }
};
