<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function apiRuc($ruc)
    {
        $url = "https://apiperu.dev/api/ruc/" . $ruc;
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $token = 'c36358c49922c564f035d4dc2ff3492fbcfd31ee561866960f75b79f7d645d7d';
        $response = $client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}",
            ],
        ]);
        
        $estado = $response->getStatusCode();
        $data = $response->getBody()->getContents();

        return $data;
    }
    public function apiDni($dni)
    {

        $url = "https://apiperu.dev/api/dni/" . $dni;
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $token = 'c36358c49922c564f035d4dc2ff3492fbcfd31ee561866960f75b79f7d645d7d';
        $response = $client->get($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}",
            ],
        ]);
        $estado = $response->getStatusCode();
        $data = $response->getBody()->getContents();

        return $data;
    }
}
