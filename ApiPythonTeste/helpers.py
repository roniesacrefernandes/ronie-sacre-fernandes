from datetime import datetime

def convert_list_to_json(data_list):
    """
    Converte uma lista de strings (onde cada string representa uma linha de dados CSV) 
    em uma lista de objetos JSON.

    Argumentos:
        data_list: Uma lista de strings, onde cada string é uma linha de dados CSV.

    Retorna:
        Uma lista de dicionários, onde cada dicionário representa um objeto JSON.
    """

    fields = [
        "RptDt", "TckrSymb", "Asst", "AsstDesc", "SgmtNm", "MktNm", "SctyCtgyNm", "XprtnDt", "XprtnCd",
        "TradgStartDt", "TradgEndDt", "BaseCd", "ConvsCritNm", "MtrtyDtTrgtPt", "ReqrdConvsInd", "ISIN",
        "CFICd", "DlvryNtceStartDt", "DlvryNtceEndDt", "OptnTp", "CtrctMltplr", "AsstQtnQty", "AllcnRndLot",
        "TradgCcy", "DlvryTpNm", "WdrwlDays", "WrkgDays", "ClnrDays", "RlvrBasePricNm", "OpngFutrPosDay",
        "SdTpCd1", "UndrlygTckrSymb1", "SdTpCd2", "UndrlygTckrSymb2", "PureGoldWght", "ExrcPric", "OptnStyle",
        "ValTpNm", "PrmUpfrntInd", "OpngPosLmtDt", "DstrbtnId", "PricFctr", "DaysToSttlm", "SrsTpNm",
        "PrtcnFlg", "AutomtcExrcInd", "SpcfctnCd", "CrpnNm", "CorpActnStartDt", "CtdyTrtmntTpNm", "MktCptlstn",
        "CorpGovnLvlNm"
    ]

    json_data = []
    for row in data_list:
        values = row.strip().split(";")  
        if len(values) == len(fields):
            json_data.append(dict(zip(fields, values)))
        else:
            print(f"Linha inválida encontrada: {row}")

    return json_data

def converter_data(data_str):
    """Converte uma data no formato dd/mm/aaaa para aaaa-mm-dd.

    Args:
        data_str (str): A data no formato dd/mm/aaaa.

    Returns:
        str: A data no formato aaaa-mm-dd, ou None em caso de erro.
    """

    try:
        # Verifica se a data tem o formato esperado
        data_obj = datetime.strptime(data_str, "%d/%m/%Y")
        return data_obj.strftime("%Y-%m-%d")
    except ValueError:
        return None
