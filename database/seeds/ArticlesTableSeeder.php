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

        $cover  = [
            '/cover/cover1.jpg',
            '/cover/cover2.jpg',
            '/cover/cover3.jpg',
            '/cover/cover4.jpg',
            '/cover/cover5.jpg',
            '/cover/cover6.jpg',
            '/cover/cover7.jpg'
        ];


        $category_id = Category::all()->pluck('id')->toArray();

        $articles = factory(Article::class)
                    ->times(100)
                    ->make()
                    ->each(function ($article, $index)
                        use ($faker, $user_id, $category_id, $cover)
                    {
                        $article->user_id = $faker->randomElement($user_id);
                        $article->cover = $faker->randomElement($cover);
                        $user = User::find($article->user_id);
                        $user->work_count++;
                        $user->save();
                        $article->category_id = $faker->randomElement($category_id);
                        $article->excerpt = make_excerpt($article->title);

                    });

        Article::insert($articles->toArray());

    }
}
