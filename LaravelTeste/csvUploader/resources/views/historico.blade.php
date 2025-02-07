<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historico</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <nav>
        <img src="{{ asset('images/oliveira_trust.jpg') }}" alt="Logo" class="logo">
        <div class="nav-links">
            <a href="{{ url('/' )}}">Home</a>
            <a href="{{ url('/' )}}">Upload do Arquivo</a>
            <a href="{{ url('/historico' )}}">Histórico de Upload</a>
            <a href="{{ url('/buscar' )}}">Busca Dados</a>
        </div>
    </nav>
    <h2>Histórico de Upload</h2>
    <div>
        <form action="{{ route('historicop') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" id="data" name="data" placeholder="dd/mm/aaaa">
            <input type="text" id="arquivo" name="arquivo" placeholder="Informe nome do arquivo">
            <button type="submit">Buscar</button>
        </form>
    </div>
</body>
</html>