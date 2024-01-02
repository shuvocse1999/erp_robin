<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
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
            ['answer_sheet_id' => 1,'answer' => 'Ja', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 1,'answer' => 'Nein', 'background_color' => '#FFA500'],
            ['answer_sheet_id' => 1,'answer' => 'Nicht relevent', 'background_color' => '#fff'],

            ['answer_sheet_id' => 2,'answer' => 'Nein', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 2,'answer' => 'Ja', 'background_color' => '#FFA500'],
            ['answer_sheet_id' => 2,'answer' => 'Nicht relevent', 'background_color' => '#fff'],

            ['answer_sheet_id' => 3,'answer' => 'Okay', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 3,'answer' => 'Nicht okay', 'background_color' => '#FFA500'],
            ['answer_sheet_id' => 3,'answer' => 'Nicht relevent', 'background_color' => '#fff'],

            ['answer_sheet_id' => 4,'answer' => 'Vorhanden', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 4,'answer' => 'Nicht vorhanden', 'background_color' => '#FFA500'],
            ['answer_sheet_id' => 4,'answer' => 'Nicht relevent', 'background_color' => '#fff'],

            ['answer_sheet_id' => 5,'answer' => 'Intakt', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 5,'answer' => 'Defekt', 'background_color' => '#FFA500'],
            ['answer_sheet_id' => 5,'answer' => 'Nicht relevent', 'background_color' => '#fff'],

            ['answer_sheet_id' => 6,'answer' => '>10 Minuten', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 6,'answer' => '10-60 Minuten', 'background_color' => '#d3d300'],
            ['answer_sheet_id' => 6,'answer' => 'Ab 60 Minuten', 'background_color' => '#FFA500'],

            ['answer_sheet_id' => 7,'answer' => 'Gering', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 7,'answer' => 'Mittel', 'background_color' => '#d3d300'],
            ['answer_sheet_id' => 7,'answer' => 'hoch', 'background_color' => '#F6BE00'],
            ['answer_sheet_id' => 7,'answer' => 'sehr hoch', 'background_color' => '#FF0000'],

            ['answer_sheet_id' => 8,'answer' => 'U1-Leicht', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 8,'answer' => 'U2-Mittel', 'background_color' => '#d3d300'],
            ['answer_sheet_id' => 8,'answer' => 'U3-Schwer', 'background_color' => '#F6BE00'],
            ['answer_sheet_id' => 8,'answer' => 'U4-Sehr schwer', 'background_color' => '#FF0000'],
            ['answer_sheet_id' => 8,'answer' => 'U5-Todlich', 'background_color' => '#FF0000'],

            ['answer_sheet_id' => 9,'answer' => 'intakt', 'background_color' => '#2B6123'],
            ['answer_sheet_id' => 9,'answer' => 'defekt', 'background_color' => '#FF0000'],
            ['answer_sheet_id' => 9,'answer' => 'k.A', 'background_color' => '#fff'],

            ['answer_sheet_id' => 10,'answer' => 'Textfield', 'background_color' => ''],
            ['answer_sheet_id' => 11,'answer' => 'Datum & Zeit', 'background_color' => ''],
            ['answer_sheet_id' => 12,'answer' => 'Zahlen', 'background_color' => ''],
            ['answer_sheet_id' => 13,'answer' => 'Unterschrift', 'background_color' => ''],
        ];
        DB::table('answers')->insert($answer);
    }
}
