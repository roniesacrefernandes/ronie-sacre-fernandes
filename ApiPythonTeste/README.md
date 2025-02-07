Documentação da API Flask

Introdução

Esta API permite processar e armazenar dados em um banco de dados MongoDB. Ela oferece três principais endpoints para processamento de dados, consulta de histórico e busca de informações.

Tecnologias Utilizadas

Python 3+

Flask

MongoDB (via PyMongo)

Pandas

JSON

Instalação e Execução

Clone o repositório:

git clone https://github.com/roniesacrefernandes.git
cd roniesacrefernandes

Instale as dependências:

pip install -r requirements.txt

Execute a API:

python app.py

Endpoints

1. POST /processar_dados

Descrição: Processa os dados enviados e armazena no MongoDB.

Requisição:

{
  "file_data": [
    ["dado1", "dado2", "dado3"]
  ],
  "historico": "nome_arquivo"
}

Resposta de Sucesso:

{
  "message": "Arquivo processado com sucesso"
}

Resposta de Erro (se histórico já existir):

{
  "message": "Historico ja existe"
}

2. POST /historico

Descrição: Consulta os históricos armazenados com base na data ou nome do arquivo.

Requisição:

{
  "data": "2024-02-01",
  "arquivo": "nome_arquivo"
}

Resposta:

{
  "registro": [
    {
      "DtHistorico": "2024-02-01",
      "NomeArq": "nome_arquivo"
    }
  ]
}

3. POST /buscar

Descrição: Realiza busca de registros no banco de dados com paginação.

Requisição:

{
  "data": "2024-02-01",
  "ativo": "PETR4"
}

Parâmetros de paginação:

page (padrão: 1) - Página desejada.

per_page (padrão: 10) - Registros por página.

Resposta:

{
  "registros": [
    {
      "RptDt": "2024-02-01",
      "TckrSymb": "PETR4",
      "MktNm": "Mercado",
      "SctyCtgyNm": "Categoria",
      "ISIN": "BRPETRACNOR9",
      "CrpnNm": "Petrobras"
    }
  ],
  "pagina_atual": 1,
  "total_paginas": 5
}

Considerações Finais

A API utiliza MongoDB como armazenamento.

O sistema suporta paginação no endpoint /buscar.

Caso haja falhas, a resposta incluirá a chave error com a descrição do problema.

Caso tenha dúvidas, entre em contato com o responsável pelo projeto.