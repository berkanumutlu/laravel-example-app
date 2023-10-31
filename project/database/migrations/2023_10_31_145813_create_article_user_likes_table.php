<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_user_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("article_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
            $table->foreign("article_id")->on("article")->references("id")->onDelete("cascade");
            $table->foreign("user_id")->on("users")->references("id")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_user_likes');
    }
};
