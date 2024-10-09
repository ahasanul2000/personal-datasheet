<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $imagePath = public_path('images');

        if (!file_exists($imagePath)) {
            mkdir($imagePath, 0755, true);
        }

        foreach (range(1, 5) as $index) {
            $image = $faker->image($imagePath, 5, 5, 'people', false); // false to not return the image URL

            $fileName = basename($image);

            DB::table('pds')->insert([
                'email' => $faker->unique()->safeEmail,
                'fullName' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'age' => $faker->numberBetween(18, 65),
                'image' => $fileName,
            ]);
        }
    }
}
