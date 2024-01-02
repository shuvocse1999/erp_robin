<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->truncate();

        // Seed new data
        $answer = [
            ['answer_sheet_id' => 1, 'answer' => 'Ja'],
            ['answer_sheet_id' => 1, 'answer' => 'Nein'],
            ['answer_sheet_id' => 1, 'answer' => 'Nicht relevant'],

            ['answer_sheet_id' => 2, 'answer' => 'Nein'],
            ['answer_sheet_id' => 2, 'answer' => 'Ja'],
            ['answer_sheet_id' => 2, 'answer' => 'Nicht relevant'],


            ['answer_sheet_id' => 3, 'answer' => 'Okay'],
            ['answer_sheet_id' => 3, 'answer' => 'Nicht okay'],
            ['answer_sheet_id' => 3, 'answer' => 'Nicht relevant'],


            ['answer_sheet_id' => 4, 'answer' => 'Vorhanden'],
            ['answer_sheet_id' => 4, 'answer' => 'Nicht vorhanden'],
            ['answer_sheet_id' => 4, 'answer' => 'Nicht relevant'],

            ['answer_sheet_id' => 5, 'answer' => 'Intakt'],
            ['answer_sheet_id' => 5, 'answer' => 'Defekt'],
            ['answer_sheet_id' => 5, 'answer' => 'Nicht relevant'],

            ['answer_sheet_id' => 6, 'answer' => '>10 Minuten'],
            ['answer_sheet_id' => 6, 'answer' => '10-60 Minuten'],
            ['answer_sheet_id' => 6, 'answer' => 'Ab 60 Minuten'],
        ];
        DB::table('answers')->insert($answer);
    }
}
