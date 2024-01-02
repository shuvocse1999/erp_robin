<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FormsController extends Controller
{
    public function index()
    {
        $url = "Form Template";
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
        return view('admin.forms.index', compact('data','url'));
    }

    public function specificForms(Request $request)
    {
        $url = "Forms";
        $apiKey = "5d2r2bo5n5pu5nk5o9r7id6ur1";
        $apiSecret = "rq4585lsfotg7l7t7jlruns71cp681tt1l8qc159j6ffsl257oh";
        $authToken = base64_encode($apiKey . ':' . $apiSecret);
        $headers = [
            'Authorization' => 'Basic ' . $authToken,
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->get('https://public-api.lumiformapp.com/api/v1/oauth2/token');

        $access_token = $response->json()['access_token'];
        if ($request->page != null) {
            $data = Http::withToken($access_token)->get('https://public-api.lumiformapp.com/api/v2/forms?page=' . $request->page)->json();
        } else {
            $data = Http::withToken($access_token)->get('https://public-api.lumiformapp.com/api/v2/forms')->json();
        }

        return view('admin.specific-forms.index', compact('data','url'));
    }

    public function specificFormsShow($id)
    {
        $url = "Forms";
        $apiKey = "5d2r2bo5n5pu5nk5o9r7id6ur1";
        $apiSecret = "rq4585lsfotg7l7t7jlruns71cp681tt1l8qc159j6ffsl257oh";
        $authToken = base64_encode($apiKey . ':' . $apiSecret);
        $headers = [
            'Authorization' => 'Basic ' . $authToken,
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->get('https://public-api.lumiformapp.com/api/v1/oauth2/token');

        $access_token = $response->json()['access_token'];
        $data = Http::withToken($access_token)->get('https://public-api.lumiformapp.com/api/v2/forms/' . $id)->json();
//        dd(@$data);
        return view('admin.specific-forms.show', compact('data','url'));
    }
}
