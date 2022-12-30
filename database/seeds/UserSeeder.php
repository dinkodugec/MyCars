<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // it allows to insert data in DB

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 100)->create()


        ->each(function ($user){  //each user, who is argument in this closure and creating in that moment
            factory(App\Car::class, rand(1,8))->create(   // in this closure(anonymus function) we call factory,for each user we want to connect random cars, between 1-8
                [
                    'user_id' => $user->id
                ]
            )

        ->each(function ($car){
                $tag_ids = range(1,8);
                shuffle($tag_ids);
                $assignments = array_slice($tag_ids, 0, rand(0,8)); // eg 5,2,8
                foreach($assignments as $tag_id){
                    DB::table('car_tag')
                        ->insert(  //in DB
                            [
                                'car_id' => $car->id,
                                'tag_id' => $tag_id,
                                'created_at' => Now(),
                                'updated_at' => Now()
                            ]
                        );
                }
            });
        });
    }
}