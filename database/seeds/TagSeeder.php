<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Sports' => 'primary', // blue
            'Relaxation' => 'secondary', // grey
            'Fun' => 'warning', // yellow
            'Electric' => 'success', // green
            'Hybrid' => 'light', // white grey
            'SUV' => 'info', // turquoise
            'Van' => 'danger', // red
            'OFF road' => 'dark' // black-white
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'name' => $key,
                    'slug' => $value
                ]
            );
            $tag->save();
        }

    }
}