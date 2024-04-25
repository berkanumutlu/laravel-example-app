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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("title", 80);
            $table->string("slug", 160);
            $table->text("body");
            $table->string("image")->nullable();
            $table->string("tags")->nullable();
            $table->string("seo_keywords")->nullable();
            $table->string("seo_description")->nullable();
            $table->integer("read_time")->default(0);
            $table->integer("view_count")->default(0);
            $table->integer("like_count")->default(0);
            $table->dateTime("publish_date")->nullable();
            $table->boolean("approve_status")->default(0);
            $table->boolean("status")->default(0);
            $table->unsignedBigInteger("category_id")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->foreign("category_id")->references("id")->on("categories");
            $table->foreign("user_id")->references("id")->on("users");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
