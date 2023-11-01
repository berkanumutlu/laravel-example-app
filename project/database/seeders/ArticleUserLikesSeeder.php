<?php

namespace Database\Seeders;

use App\Models\ArticleUserLikes;
use Illuminate\Database\Seeder;

class ArticleUserLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleUserLikes::factory(10)->create();
    }
}
