<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
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

    <h2>Upload de Arquivo CSV</h2>
    @if ($errors->any())
        <div>
            <strong>Erro!</strong> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Enviar</button>
    </form>
 </body>
</html>
