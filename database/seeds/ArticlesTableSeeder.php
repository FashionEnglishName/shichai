<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $user_id = User::all()->pluck('id')->toArray();

        $category_id = Category::all()->pluck('id')->toArray();

        $articles = factory(Article::class)
                    ->times(100)
                    ->make()
                    ->each(function ($article, $index)
                        use ($faker, $user_id, $category_id)
                    {
                        $article->user_id = $faker->randomElement($user_id);
                        $article->category_id = $faker->randomElement($category_id);
                    });

        Article::insert($articles->toArray());

    }
}
