<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $books = [
            [
                'title' => 'German for Beginners',
                'bookoption' => 'Option 1',
                'filter' => 'a1-a2',
                'image' => 'ebook1.jpg',
                'keywords' => json_encode(['German', 'Beginners', 'Language']),
            ],
            [
                'title' => 'Intermediate German',
                'bookoption' => 'Option 2',
                'filter' => 'b1',
                'image' => 'ebook2.jpg',
                'keywords' => json_encode(['German', 'Intermediate', 'Language']),
            ],
            [
                'title' => 'Advanced German Grammar',
                'bookoption' => 'Option 3',
                'filter' => 'b2',
                'image' => 'ebook3.jpg',
                'keywords' => json_encode(['German', 'Advanced', 'Grammar']),
            ],
        ];

        foreach ($books as $book) {
            DB::table('books')->insert($book);
        }
    }
}
