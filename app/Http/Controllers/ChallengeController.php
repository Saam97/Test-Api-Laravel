<?php

namespace App\Http\Controllers;

use App\Services\ForisChallenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function solve(ForisChallenge $challenge)
    {   
        //Login y almacenar token
        $isLoggedIn = $challenge->login();

        //Obtener las intrucciones del challenge (como traer el sql)
        $mysqlDumpContents = $challenge->getChallenge();

        // Descargar el mysql (Carpeta storage/app)
        $mysqlDumpContents = $challenge->downloadMySQLDump();

        //enviar respuesta
        //$mysqlDumpContents = $challenge->validateAnswer(168,28);

    }
}