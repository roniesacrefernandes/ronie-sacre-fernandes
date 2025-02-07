<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca Arquivo</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <nav>
    <img src="{{ asset('images/oliveira_trust.jpg') }}" alt="Logo" class="logo"> 
        <div class="nav-links"> 
            <a href="{{ url('/' )}}">Home</a>
            <a href="{{ url('/' )}}">Upload do Arquivo</a>
            <a href="{{ url('/historico' )}}">Histórico de Upload</a>
            <a href="{{ url('/buscar' )}}">Consultar Dados</a>
        </div>
    </nav>
        <div>
            <h2>Consultar Dados</h2>
            <form action="{{ route('buscarp') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" id="data" name="data" placeholder="dd/mm/aaaa"> 
                <input type="text" id="ativo" name="ativo" placeholder="Informe um ativo"> 
                <button type="submit">Buscar</button>
            </form>
        </div>
 </body>
