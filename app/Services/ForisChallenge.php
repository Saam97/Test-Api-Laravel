<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

class ForisChallenge
{
    protected $client;
    protected $baseUrl = 'http://mini-challenge.foris.ai';

    public function __construct()
{
    //dd('Construyendo la instancia de ForisChallenge');
    $this->client = new Client();
}

public function login()
{
    $response = $this->client->post($this->baseUrl . '/login', [
        'json' => [
            'username' => 'foris_challenge',
            'password' => 'ForisChallenge',
        ],
    ]);
    
    $responseData = json_decode($response->getBody(), true);
    //dd($responseData); Mas instrucciones

    if ($response->getStatusCode() === 200) {
        $accessToken = $responseData['access_token'];
        session(['token' => $accessToken]);
        return true;
    }

    return false;
}

public function getChallenge()
{
    $accessToken = session('token');

    if (!$accessToken) {
        throw new Exception('No se encontró el token de acceso en la sesión.');
    }

    $headers = [
        'Authorization' => 'Bearer ' . $accessToken,
    ];
    //dd($headers); revisar el formato adecuado

    $response = $this->client->get($this->baseUrl . '/challenge', [
        'headers' => $headers,
    ]);

    if ($response->getStatusCode() === 200) {
        $challenge = $response->getBody()->getContents();
        dd($challenge); // Imprime el contenido de la respuesta, Mas intrucciones 
        return $challenge;
    }

    throw new Exception('Error al obtener el desafío: ' . $response->getBody()->getContents());
}

public function validateAnswer($numberOfGroups, $answer)
{
    $accessToken = session('token');
    if (!$accessToken) {
        throw new Exception('No se encontró el token de acceso en la sesión.');
    }

    $headers = [
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json'
    ];

    $response = $this->client->post($this->baseUrl . '/validate', [
        'headers' => $headers,
        'json' => [
            'number_of_groups' => $numberOfGroups,
            'answer' => $answer
        ]
    ]);

    // Obtener el cuerpo de la respuesta
    $responseBody = $response->getBody()->getContents();

    // Decodificar el cuerpo de la respuesta JSON
    $responseData = json_decode($responseBody, true);

    //dd($responseData); //La respuesta es correcta

    //  // Verificar el estado de la respuesta
    //  if ($response->getStatusCode() === 200) {
    //     if ($responseData['msg'] === 'Your answer its correct!') {
    //         return true; // La respuesta es correcta
    //     } else {
    //         return false; // La respuesta es incorrecta
    //     }
    // } else {
    //     throw new Exception('Error al validar la respuesta: ' . $response->getBody()->getContents());
    // }
}

    public function downloadMySQLDump()
{
    $accessToken = session('token');

    if (!$accessToken) {
        throw new Exception('No se encontró el token de acceso en la sesión.');
    }

    $headers = [
        'Authorization' => 'Bearer ' . $accessToken,
    ];

    $response = $this->client->get($this->baseUrl . '/dumps/mysql', [
        'headers' => $headers,
        'sink' => storage_path('app/mysql_dump.sql'), // Guardar el archivo descargado en esta ruta
    ]);

    if ($response->getStatusCode() === 200) {
        $filePath = storage_path('app/mysql_dump.sql');
        $fileContents = file_get_contents($filePath);
        //dd($fileContents); // Imprimir el contenido del archivo descargado
        return $fileContents;
    }

    throw new Exception('Error al descargar el volcado de MySQL: ' . $response->getBody()->getContents());
}
}