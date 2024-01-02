<?php

namespace App\Imports;

use App\Models\Messunger;
use App\Models\MessungerList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MessungenImport implements ToModel, WithHeadingRow
{
    public $user;
    private $firstRowProcessed = false;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function collection(Collection $collection)
    {

    }

    public function model(array $row)
    {
//        dd($row);
        // Process only the first row for Messunger
        if (!$this->firstRowProcessed) {
            $messunger = Messunger::create([
                'user_id' => $this->user,
                'A' => $row['datumzeit'],
                'B' => $row['temperatur'],
                'C' => $row['t_max'],
                'D' => $row['t_min'],
                'E' => $row['relative_luftfeuchtigkeit'],
                'H' => $row['larmpegel_aktuell'],
                'I' => $row['la_max'],
                'J' => $row['la_min'],
                'N' => $row['beleuchtungsstarke'],
                'AC' => $row['co2'],
                'AD' => $row['co2_max'],
                'AE' => $row['co2_min'],
                'AF' => $row['tvoc'],
                'AG' => $row['tvoc_max'],
                'AH' => $row['tvoc_min'],
                'AI' => $row['co'],
                'AJ' => $row['co_max'],
                'AK' => $row['co_min'],
                'AL' => $row['pm1u0'],
                'AM' => $row['pm1u0_max'],
                'AN' => $row['pm1u0_min'],
                'AO' => $row['pm2u5'],
                'AP' => $row['pm2u5_max'],
                'AQ' => $row['pm2u5_min'],
                'AR' => $row['pm10u'],
                'AS' => $row['pm10u_max'],
                'AT' => $row['pm10u_min'],
            ]);

            $this->firstRowProcessed = true;

            return $messunger;
        }

        return new MessungerList([
            'messunger_id' => $this->getLastMessungerId(),
            'A' => $row['datumzeit'],
            'B' => $row['temperatur'],
            'C' => $row['t_max'],
            'D' => $row['t_min'],
            'E' => $row['relative_luftfeuchtigkeit'],
            'H' => $row['larmpegel_aktuell'],
            'I' => $row['la_max'],
            'J' => $row['la_min'],
            'N' => $row['beleuchtungsstarke'],
            'AC' => $row['co2'],
            'AD' => $row['co2_max'],
            'AE' => $row['co2_min'],
            'AF' => $row['tvoc'],
            'AG' => $row['tvoc_max'],
            'AH' => $row['tvoc_min'],
            'AI' => $row['co'],
            'AJ' => $row['co_max'],
            'AK' => $row['co_min'],
            'AL' => $row['pm1u0'],
            'AM' => $row['pm1u0_max'],
            'AN' => $row['pm1u0_min'],
            'AO' => $row['pm2u5'],
            'AP' => $row['pm2u5_max'],
            'AQ' => $row['pm2u5_min'],
            'AR' => $row['pm10u'],
            'AS' => $row['pm10u_max'],
            'AT' => $row['pm10u_min'],
        ]);

    }

    private function getLastMessungerId()
    {
        return Messunger::latest()->first()->id;
    }
}
