<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoricoController extends Controller
{
    public function historico()
    {
        return view('historico');
    }

    public function historicop(Request $request)
    {

        $data = $request->input('data');
        $arquivo = $request->input('arquivo');

        
        $response = Http::post('http://127.0.0.1:5000/historico', [
            'data'  => $data, 'arquivo' => $arquivo
        ]);

        return $response->json();
        
    }


}
