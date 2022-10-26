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

    public function getRotulos(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $filial = $request->input('FILIAL_O');
        $reqNro = $request->input('REQUI_NRO');
        $reqSerie = $request->input('REQUI_SERIE');

        $myAddress = '187.22.222.19';
        $key = md5("ProjetoRotulo") . '@|@' . md5($myAddress) . '@|@' . md5(date('Ymd'));
        $parametros = 'KEY=' . $key . '&webBUSCA=' . 'REQsD' . '&' . 'FILIAL_O=' . $filial . '&REQUI_NRO=' . $reqNro . '&REQUI_SERIE=' . $reqSerie;
        $url = "http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?${parametros}";
        $xml = json_encode(simplexml_load_file($url));
        $xmlConverted = json_decode($xml, true);
        return response($xmlConverted);
    }

    public function getAnexos(Request $request)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $filial = $request->input('FILIAL_O');
        $reqNro = $request->input('REQUI_NRO');
        $reqSerie = $request->input('REQUI_SERIE');

        $myAddress = '187.22.222.19';
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

    public function makePDF(Request $request)
    {
        $nroPedido = $request->input('nroPedido');
        $texto = 'JULIO';
        $pdf = Pdf::loadView('pdf', compact('texto'),);
        $customPaper = array(0, 0, 400, 200);

        return $pdf->setPaper($customPaper)->stream('teste.pdf');
    }

    public function createRotulo(Request $request)
    {
        $request->validate([
            'nro_requisicao' => 'required',
            'formula' => 'required',
            'posologia' => 'required'
        ]);

        //dd($request);

        Rotule::create($request->all());

        return response('Rótulo criado com sucesso');
    }
}
