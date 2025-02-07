from flask import Flask, jsonify, request
import pandas as pd 
from pymongo import MongoClient #pip install flask pymongo
import json
from bson.json_util import dumps
from datetime import datetime
from helpers import convert_list_to_json, converter_data
from math import ceil

app = Flask(__name__)

# Conectar ao MongoDB
client = MongoClient("mongodb://localhost:27017/")  
db = client["boletim_diario"]
# Criando coleções separadas
collection = db["boletim"]
collection = db["historico"]

@app.route('/')
def home():
    return ""

@app.route('/processar_dados', methods=['POST'])
def processar_dados():
    dados = request.get_json()
    file_data = dados.get('file_data', None) 
    historico = dados.get('historico', None) 

    #verificar se já existe o historico
    query = {}
    query['NomeArq'] = historico
    result = collection.historico.find_one(query)

    if not result:
        for linha in file_data: 
            dados_json = convert_list_to_json(linha) 
            # Inserir os dados do boletim no MongoDB
            collection.boletim.insert_many(dados_json)

        # Inserir os dados do historico no MongoDB
        data_atual = datetime.now().strftime("%Y-%m-%d")
        fields = {"DtHistorico": data_atual, "NomeArq" : historico}
        collection.historico.insert_one(fields)

        return jsonify({'message': 'Arquivo processado com sucesso'})
    else:
        return jsonify({'message': 'Historico ja existe'}), 400

@app.route('/historico', methods=['POST'])
def processar_historico():
    try:
        dados = request.get_json()

        data_recebida = dados.get('data', None) 
        data_formatada = ""
        if data_recebida:
            data_formatada = converter_data(data_recebida)

        arquivo = dados.get('arquivo', None) 

        # Construir a consulta
        query = {}
        if data_recebida:
            query['DtHistorico'] = data_formatada
        if arquivo:
            query['NomeArq'] = arquivo

        results = list(collection.historico.find(query))

        data_list = []
        for result in results:
            data_list.append({
                'DtHistorico': result['DtHistorico'],
                'NomeArq': result['NomeArq']
            })

        return jsonify({'registro': data_list}), 200            

    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/buscar', methods=['POST'])
def buscar():
    try:
        dados = request.get_json()

        #rpt_dt = dados.get('data', None) 
        data_recebida = dados.get('data', None) 
        data_formatada = ""
        if data_recebida:
            data_formatada = converter_data(data_recebida)

        tckr_symb = dados.get('ativo', None) 

        # Construir a consulta
        query = {}
        if tckr_symb:
            query['TckrSymb'] = tckr_symb
        if data_recebida:
            query['RptDt'] = data_formatada

        # Obtenha os parâmetros de paginação
        page = request.args.get('page', 1, type=int)
        per_page = request.args.get('per_page', 10, type=int)

       # Executar a consulta
        if tckr_symb or data_recebida:
       #     results = list(collection.boletim.find(query))
            results = list(collection.boletim.find(query).skip((page - 1) * per_page).limit(per_page))
            total_results = collection.boletim.count_documents(query)
            total_pages = ceil(total_results / per_page)
        else:
        #    results = list(collection.boletim.find())  
            results = list(collection.boletim.find().skip((page - 1) * per_page).limit(per_page))
            total_results = collection.boletim.count_documents({})
            total_pages = ceil(total_results / per_page)


        data_list = []
        for result in results:
            data_list.append({
                'RptDt': result['RptDt'],
                'TckrSymb': result['TckrSymb'],
                'MktNm': result['MktNm'],
                'SctyCtgyNm': result['SctyCtgyNm'],
                'ISIN': result['ISIN'],
                'CrpnNm': result['CrpnNm']
            })

        #return jsonify({'registros': data_list}), 200            

        return jsonify({
                'registros': data_list,
                'pagina_atual': page,
                'total_paginas': total_pages
            }), 200

    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
