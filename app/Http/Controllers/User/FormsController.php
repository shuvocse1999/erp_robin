<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class FormsController extends Controller
{
    public function index()
    {
        $apiKey = "5d2r2bo5n5pu5nk5o9r7id6ur1";
        $apiSecret = "rq4585lsfotg7l7t7jlruns71cp681tt1l8qc159j6ffsl257oh";
        $authToken = base64_encode($apiKey . ':' . $apiSecret);
        $headers = [
            'Authorization' => 'Basic ' . $authToken,
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->get('https://public-api.lumiformapp.com/api/v1/oauth2/token');

        $access_token = $response->json()['access_token'];
        $data = Http::withToken($access_token)->get('https://public-api.lumiformapp.com/api/v2/filters/form-templates')->json();
        return view('user.forms.index', compact('data'));
    }

    public function submitForm(Request $request)
    {
        $client = Client::findOrFail($request->client_id);
        if ($request->has('status')) {
            $client->status = $request->status;
        }
        if ($request->has('priorität')) {
            $client->priorität = $request->priorität;
        }
        $client->save();

        return redirect()->route('clients.index')
            ->with('success', 'Updated successfully!');
    }

}
