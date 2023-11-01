<?php

namespace Database\Seeders;

use App\Models\ArticleFeatures;
use Illuminate\Database\Seeder;

class ArticleFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleFeatures::factory(10)->create();
    }
}
