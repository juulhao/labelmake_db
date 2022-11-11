<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use setasign\FPDI;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Rotule;

class RotuloController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function getProfile()
    {
        return view('users');
    }

    /*
        Busca os rótulos na webservice do cliente e retorna um JSON para o frontend consumir.
    */
    public function getRotulos(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $filial = $request->input('FILIAL_O');
        $reqNro = $request->input('REQUI_NRO');
        $reqSerie = $request->input('REQUI_SERIE');

        $myAddress = '187.22.222.19'; // Este endereço precisa ser o mesmo do IP da sua máquina

        $key = md5("ProjetoRotulo") . '@|@' . md5($myAddress) . '@|@' . md5(date('Ymd'));
        $parametros = 'KEY=' . $key . '&webBUSCA=' . 'REQsD' . '&' . 'FILIAL_O=' . $filial . '&REQUI_NRO=' . $reqNro . '&REQUI_SERIE=' . $reqSerie;
        $url = "http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?${parametros}";
        $xml = json_encode(simplexml_load_file($url));
        $xmlConverted = json_decode($xml, true);
        return response($xmlConverted);
    }
    /*
        Busca pelos anexos (Imagens) nos objetos fornecidos pela webservice
    */
    public function getAnexos(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $filial = $request->input('FILIAL_O');
        $reqNro = $request->input('REQUI_NRO');
        $reqSerie = $request->input('REQUI_SERIE');

        $myAddress = '187.22.222.19'; // Este endereço precisa ser o mesmo do IP da sua máquina
        $key = md5("ProjetoRotulo") . '@|@' . md5($myAddress) . '@|@' . md5(date("Ymd"));
        $parametros2 = 'KEY=' . $key . '&webBUSCA=' . 'REQsD' . '&' . 'FILIAL_O=' . $filial . '&REQUI_NRO=' . $reqNro . '&REQUI_SERIE=' . $reqSerie;

        $xml = json_encode(simplexml_load_file('http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?' . $parametros2));
        $xmlConverted = json_decode($xml, true);

        $parametros =     'KEY=' . $key .
            '&webBUSCA=imgREC&FILIAL_O=' . $filial .
            '&REQUI_NRO=' . $reqNro .
            '&PEDIDO_NRO=' . ltrim(rtrim($xmlConverted['RECNO1']['NRO_PEDIDO_MOBY'])) .
            '&SESS=afg1234567890';

        $xmlIMG = json_encode(simplexml_load_file('http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?' . $parametros));
        $xmlIMGConverted = json_decode($xmlIMG, true);
        return response($xmlIMGConverted);
    }
    /*
        Busca na tabela `rotules`, pelas colunas `posologia` e `formula`, depois retorna estes arrays de strings juntamente com os outros dados da webservice, para no final montar um PDF dinamicamente de acordo com o template fornecido
    */
    public function makePDF(Request $request)
    {
        $nroPedido = $request->input('nroPedido'); // Busca o nroPedido como parâmetro da URL
        $template = $request->input('template'); // Busca o template como parâmetro da URL

        date_default_timezone_set('America/Sao_Paulo');

        $filial = substr($nroPedido, 0, 4);
        $reqNro = substr($nroPedido, 5, 6);
        $reqSerie = $nroPedido[12];

        $myAddress = '187.22.222.19'; // Deve ser o mesmo ip da sua máquina
        $key = md5("ProjetoRotulo") . '@|@' . md5($myAddress) . '@|@' . md5(date('Ymd'));
        $parametros = 'KEY=' . $key . '&webBUSCA=' . 'REQsD' . '&' . 'FILIAL_O=' . $filial . '&REQUI_NRO=' . $reqNro . '&REQUI_SERIE=' . $reqSerie;
        $url = "http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?${parametros}";
        $xml = json_encode(simplexml_load_file($url));
        $xmlConverted = json_decode($xml, true);

        // Todos estes campos representam as linhas do PDF
        $nomeDoPaciente = $xmlConverted['RECNO1']['NOME_CLIENTE'];
        $nomeProduto = $xmlConverted['RECNO1']['DESCR_PRODUTO'];
        $validadeProduto = $xmlConverted['RECNO1']['DATA_VALIDADE_PRODUCAO'];
        $dataFabricacao = $xmlConverted['RECNO1']['DATA_PRODUCAO'];
        $nomeDoutor = $xmlConverted['RECNO1']['PRESCRITOR_NOME'];
        $crmDoutor = $xmlConverted['RECNO1']['PRESCRITOR_CRM_NRO'];
        $contem = $xmlConverted['RECNO1']['CONTEM'];
        $reqProduto = $xmlConverted['RECNO1']['REQ_CDPRO'];
        $regProduto = $xmlConverted['RECNO1']['REGISTRO_NRO'];
        $farmaceutica = $xmlConverted['RECNO1']['FARMACEUTICA_RESP'];
        $farmaceuticaCRF = $xmlConverted['RECNO1']['FARMACEUTICA_CRF'];
        $enderecoRotulo = $xmlConverted['RECNO1']['ENDERECO_PARA_ROTULO'];
        $cnpjFILIAL = $xmlConverted['RECNO1']['FILIAL_ESTOQUE_CNPJ'];
        $DDDtelefoneFilial = $xmlConverted['RECNO1']['FILIAL_ESTOQUE_DDD'];
        $telefoneFilial = $xmlConverted['RECNO1']['FILIAL_ESTOQUE_TELEFONE'];
        $formulas = Rotule::where('nro_requisicao', $nroPedido)->orderBy('id', 'desc')->value('formula');
        $posologias = Rotule::where('nro_requisicao', $nroPedido)->orderBy('id', 'desc')->value('posologia');

        // O array que é enviado para o Blade View renderizar o PDF
        $data = [
            'nomePaciente'    => $nomeDoPaciente,
            'nomeProduto' => $nomeProduto,
            'validadeProduto' => $validadeProduto,
            'dataFabricao' => $dataFabricacao,
            'nomeDoutor' =>  $nomeDoutor,
            'crmDoutor' => $crmDoutor,
            'contem' => $contem,
            'reqProduto' => $reqProduto,
            'regProduto' => $regProduto,
            'farmaceutica' => $farmaceutica,
            'farmaceuticaCRF' => $farmaceuticaCRF,
            'enderecoRotulo' => $enderecoRotulo,
            'cnpjFILIAL' => $cnpjFILIAL,
            'DDDFilial' => $DDDtelefoneFilial,
            'telefoneFilial' => $telefoneFilial,
            'formulas' => $formulas,
            'posologias' => $posologias
        ];
        $pdf = PDF::loadView('Pdfs/' . $template, $data); // $template = é o nome do arquivo na pasta `resources/Bisnagas/AF_B1.blade.php` este nome é enviado pelo frontend da aplicação
        return $pdf->stream('result.pdf'); // cria dinamicamente o pdf
    }

    // este método cria os rotulos editados pelo frontend e salva na tabela rotules
    public function createRotulo(Request $request)
    {
        $request->validate([
            'nro_requisicao' => 'required',
            'formula' => 'required',
            'posologia' => 'required'
        ]);

        Rotule::create($request->all());

        return response('Rótulo criado com sucesso');
    }
}
