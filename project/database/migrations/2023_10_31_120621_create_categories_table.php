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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 60);
            $table->string("slug", 150);
            $table->string("image")->nullable();
            $table->string("description")->nullable();
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->boolean("status")->default(0);
            $table->boolean("feature_status")->default(0);
            $table->integer("order")->default(0)->nullable();
            $table->string("color")->nullable();
            $table->string("seo_keywords")->nullable();
            $table->string("seo_description")->nullable();
            $table->timestamps();
            $table->foreign("parent_id")->references("id")->on("categories")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
