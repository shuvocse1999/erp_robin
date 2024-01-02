<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answer_sheets')->truncate();

        // Seed new data
        $answerSheet = [
            ['title' => 'A'],
            ['title' => 'B'],
            ['title' => 'C'],
            ['title' => 'D'],
            ['title' => 'E'],
            ['title' => 'F'],
            ['title' => 'G'],
            ['title' => 'H'],
            ['title' => 'I'],
            ['title' => 'J'],
            ['title' => 'K'],
            ['title' => 'L'],
            ['title' => 'M'],
        ];
        DB::table('answer_sheets')->insert($answerSheet);
    }
}
