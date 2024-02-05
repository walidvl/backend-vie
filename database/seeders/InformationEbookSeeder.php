<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Crypt;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class InformationEbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('information_ebooks')->insert([
            'title' => 'ebook3',
            'small_title' => 'goethprufung',
            'description' => 'This2 is a description paragraph with up to 30 words.',
            'tags_table' => json_encode(['prufung', 'goeth', 'osd']),
            'date' => Carbon::now(),
            'price' => 'free',
            'encrypted_link' =>'https://drive.google.com/file/d/1A9Nyfq8CqiqtRkQIavcYEy699SXBVQ7B/view',
            'created_at' => now(),
            'updated_at' => now(),

        ]);
    }
}

// public function run()
//     {
//         $faker = Faker::create();

//         for ($i = 0; $i < 5; $i++) {
//             DB::table('information_ebooks')->insert([
//                 'title' => $faker->sentence,
//                 'small_title' => $faker->words(3, true),
//                 'description' => $faker->paragraph,


// 'tags_table' => json_encode($faker->words(5)),
//                 'date' => $faker->date,
//                 'price' => $faker->randomFloat(2, 10, 100),
//                 'created_at' => now(),
//                 'updated_at' => now(),
//             ]);
//         }
//     }
// }