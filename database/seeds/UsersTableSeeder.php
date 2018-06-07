<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Faker\Generator::class);

        $avatars = [
            'http://p9nmr7txh.bkt.clouddn.com/presentation/cover1.jpg',
            'http://p9nmr7txh.bkt.clouddn.com/presentation/cover2.jpg',
            'http://p9nmr7txh.bkt.clouddn.com/presentation/cover3.JPG',
            'http://p9nmr7txh.bkt.clouddn.com/presentation/cover4.jpg',
            'http://p9nmr7txh.bkt.clouddn.com/presentation/cover5.JPG'
        ];

        $users = factory(User::class)
                 ->times(10)
                 ->make()
                 ->each(function($user, $index)
                        use($faker, $avatars)
                 {
                    $user->avatar = $faker->randomElement($avatars);
                    $user->name = make_excerpt($user->name, 10);
                 });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        $user = User::find(1);
        $user->name = 'dmh';
        $user->password = bcrypt('dddddd');
        $user->email = 'dmh@qq.com';
        $user->avatar = 'http://p9nmr7txh.bkt.clouddn.com/presentation/cover1.jpg';
        $user->save();

        $user->assignRole('Founder');

        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
