<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Begehung;
use App\Models\Beinaheunfall;
use App\Models\InterneUnfallmeldung;
use App\Models\Maschinenabnahme;
use App\Models\Tatigkeitsbericht;
use Illuminate\Http\Request;

class BerichteController extends Controller
{
    public function begehung(Request $request)
    {
        $query = Begehung::query();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('Standort', 'like', "%{$key}%")
                    ->orWhere('Erstellt_von', 'like', "%{$key}%")
                    ->orWhere('Anlass', 'like', "%{$key}%")
                    ->orWhere('Abteilung_Bereich', 'like', "%{$key}%")
                    ->orWhere('Thema_Problem_Missstand', 'like', "%{$key}%")
                    ->orWhere('Bild', 'like', "%{$key}%")
                    ->orWhere('Information_Mangel', 'like', "%{$key}%")
                    ->orWhere('Bemerkungen', 'like', "%{$key}%")
                    ->orWhere('Bewertung', 'like', "%{$key}%")
                    ->orWhere('Gesamtrisiko', 'like', "%{$key}%")
                    ->orWhere('Mabnahmenplanung', 'like', "%{$key}%")
                    ->orWhere('Ubertrag_Gefahrdungs', 'like', "%{$key}%")
                    ->orWhere('created_at', 'like', "%{$key}%")
                    ->orWhere('updated_at', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Begehung";
        $data['search'] = $request->search;
        $data['begehung'] = $query->paginate(10);
        return view('admin.berichte.begehung', $data);
    }

    public function beinaheunfall(Request $request)
    {
        $query = Beinaheunfall::latest();

        if ($request->has('search')) {
            $key = '%' . $request->input('search') . '%';
            $query->where(function ($q) use ($key) {
                $q->where('Standort', 'like', $key)
                    ->orWhere('Vorbereitet_von', 'like', $key)
                    ->orWhere('Datum', 'like', $key)
                    ->orWhere('Genauer_Beinaheunfalls', 'like', $key)
                    ->orWhere('aus-1', 'like', $key)
                    ->orWhere('aus-2', 'like', $key)
                    ->orWhere('aus-3', 'like', $key)
                    ->orWhere('aus-4', 'like', $key)
                    ->orWhere('aus-5', 'like', $key)
                    ->orWhere('Beschreibe', 'like', $key);
            });
        }

        $data['url'] = "Beinaheunfall";
        $data['search'] = $request->search;
        $data['beinaheunfall'] = $query->paginate(10);

        return view('admin.berichte.beinaheunfall', $data);
    }

    public function interne_unfallmeldung(Request $request)
    {
        $query = InterneUnfallmeldung::latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('standort', 'like', "%{$key}%")
                    ->orWhere('Zustandige', 'like', "%{$key}%")
                    ->orWhere('erstellt_von', 'like', "%{$key}%")
                    ->orWhere('abgeseschlossen_am', 'like', "%{$key}%")
                    ->orWhere('Abteilung', 'like', "%{$key}%")
                    ->orWhere('Name_des_Verunfallten', 'like', "%{$key}%")
                    ->orWhere('Berufshauptgruppe', 'like', "%{$key}%")
                    ->orWhere('Zeitpunkt_des_Unfalls', 'like', "%{$key}%")
                    ->orWhere('Ausgefallene_Arbeitstage', 'like', "%{$key}%")
                    ->orWhere('Art_des_Unfalls', 'like', "%{$key}%")
                    ->orWhere('Sonstige_Schaden', 'like', "%{$key}%")
                    ->orWhere('Betroffene_Korperteile', 'like', "%{$key}%")
                    ->orWhere('Art_der_Verletzung', 'like', "%{$key}%")
                    ->orWhere('Bauliche_Einrichtung', 'like', "%{$key}%")
                    ->orWhere('Schwere_des_Unfalls', 'like', "%{$key}%")
                    ->orWhere('Korrekturmabnahmen_angezeigt', 'like', "%{$key}%")
                    ->orWhere('Korrekturmabnahme', 'like', "%{$key}%")
                    ->orWhere('Mabnahme', 'like', "%{$key}%")
                    ->orWhere('Deadline', 'like', "%{$key}%")
                    ->orWhere('Status', 'like', "%{$key}%")
                    ->orWhere('Prioritat', 'like', "%{$key}%")
                    ->orWhere('Abfrage', 'like', "%{$key}%")
                    ->orWhere('beschreibung', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Interne unfallmeldung";
        $data['search'] = $request->search;
        $data['interne_unfallmeldung'] = $query->paginate(10);
        return view('admin.berichte.interne_unfallmeldung', $data);
    }

    public function maschinenabnahme(Request $request)
    {
        $query = Maschinenabnahme::latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('standort', 'like', "%{$key}%")
                    ->orWhere('Erstellt_von', 'like', "%{$key}%")
                    ->orWhere('kategories', 'like', "%{$key}%")
                    ->orWhere('abteilung_bereich', 'like', "%{$key}%")
                    ->orWhere('Thema_Problem_Missstand', 'like', "%{$key}%")
                    ->orWhere('information_mangel', 'like', "%{$key}%")
                    ->orWhere('bemerkungen', 'like', "%{$key}%")
                    ->orWhere('Bewertung', 'like', "%{$key}%")
                    ->orWhere('Gesamtrisiko', 'like', "%{$key}%")
                    ->orWhere('ubertrag_in_die', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Maschinenabnahme";
        $data['search'] = $request->search;
        $data['maschinenabnahme'] = $query->paginate(10);
        return view('admin.berichte.maschinenabnahme', $data);
    }

    public function tatigkeitsbericht(Request $request)
    {
        $query = Tatigkeitsbericht::latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('Standort', 'like', "%{$key}%")
                    ->orWhere('Erstellt_von', 'like', "%{$key}%")
                    ->orWhere('Kategorie', 'like', "%{$key}%")
                    ->orWhere('Beschreibung', 'like', "%{$key}%")
                    ->orWhere('Dauer_Aufwand', 'like', "%{$key}%")
                    ->orWhere('Dieser_Abs', 'like', "%{$key}%")
                    ->orWhere('Beginn', 'like', "%{$key}%")
                    ->orWhere('Ende', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Tatigkeitsbericht";
        $data['search'] = $request->search;
        $data['tatigkeitsbericht'] = $query->paginate(10);
        return view('admin.berichte.tatigkeitsbericht', $data);
    }


}
