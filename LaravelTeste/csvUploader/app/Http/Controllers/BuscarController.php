<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuscarController extends Controller
{
    public function buscar()
    {
        return view('buscar');
    }

    public function buscarp(Request $request)
    {
        $data = $request->input('data');
        $ativo = $request->input('ativo');
        
        $response = Http::post('http://127.0.0.1:5000/buscar', [
            'data' => $data, 'ativo' => $ativo
        ]);

        $data = $response->json();
        $registros = $data['registros'];
        $pagina_atual = $data['pagina_atual'];
        $total_paginas = $data['total_paginas'];

        echo '<table>';
        echo '<tr><th>RptDt</th><th>TckrSymb</th><th>MktNm</th><th>SctyCtgyNm</th><th>ISIN</th><th>CrpnNm</th></tr>';
        foreach ($registros as $registro) {
            echo '<tr>';
            echo '<td>' . $registro['RptDt'] . '</td>';
            echo '<td>' . $registro['TckrSymb'] . '</td>';
            echo '<td>' . $registro['MktNm'] . '</td>';
            echo '<td>' . $registro['SctyCtgyNm'] . '</td>';
            echo '<td>' . $registro['ISIN'] . '</td>';
            echo '<td>' . $registro['CrpnNm'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';

        // Links de paginação
        echo '<a href="?page=' . ($pagina_atual - 1) . '">Anterior</a>';
        echo '<a href="?page=' . ($pagina_atual + 1) . '">Próximo</a>';

    }

}
