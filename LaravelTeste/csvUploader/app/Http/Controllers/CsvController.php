<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CsvController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $nome_arquivo = $file->getClientOriginalName();
        $csvData = array_map('str_getcsv', file($path));
         
        $data = [];
        $header = array_shift($csvData); 

        foreach ($csvData as $row) {
            $data[] = $row; 
        }
        
        $response = Http::post('http://127.0.0.1:5000/processar_dados', [
            'file_data'  => $data, 'historico' => $nome_arquivo
        ]);

        return $response->json();

        

    }
}
