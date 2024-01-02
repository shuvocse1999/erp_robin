<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('firma', 'like', "%{$key}%")
                    ->orWhere('email', 'like', "%{$key}%")
                    ->orWhere('vorname', 'like', "%{$key}%")
                    ->orWhere('nachname', 'like', "%{$key}%")
                    ->orWhere('adresse', 'like', "%{$key}%")
                    ->orWhere('postleitzahl', 'like', "%{$key}%")
                    ->orWhere('ort', 'like', "%{$key}%")
                    ->orWhere('telefon', 'like', "%{$key}%")
                    ->orWhere('status', 'like', "%{$key}%")
                    ->orWhere('priorität', 'like', "%{$key}%");
            });
        }
        $data['url'] = "Clients";
        $data['search'] = $request->search;
        $data['clients'] = $query->paginate(10);
        return view('clients.index', $data);
    }

    public function create()
    {
        $data['url'] = "Clients Create";
        return view('clients.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firma' => ['required'],
            'vorname' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $client = new Client();
        $client->firma = $request->input('firma');
        $client->vorname = $request->input('vorname');
        $client->nachname = $request->input('nachname');
        $client->adresse = $request->input('adresse');
        $client->postleitzahl = $request->input('postleitzahl');
        $client->ort = $request->input('ort');
        $client->email = $request->input('email');
        $client->telefon = $request->input('telefon');
        $client->status = $request->input('status');
        $client->priorität = $request->input('priorität');
        $client->save();
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }


    public function edit($id)
    {
        $data['url'] = "Client Edit";
        $data['client'] = Client::find($id);
        return view('clients.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firma' => ['required'],
            'vorname' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $client = Client::findOrFail($id);
        $client->firma = $request->input('firma');
        $client->vorname = $request->input('vorname');
        $client->nachname = $request->input('nachname');
        $client->adresse = $request->input('adresse');
        $client->postleitzahl = $request->input('postleitzahl');
        $client->ort = $request->input('ort');
        $client->email = $request->input('email');
        $client->telefon = $request->input('telefon');
        $client->status = $request->input('status');
        $client->priorität = $request->input('priorität');
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }


    public function delete($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }


}
