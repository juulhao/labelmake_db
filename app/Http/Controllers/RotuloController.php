<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RotuloController extends Controller
{

    public function getProfile()
    {
        return view('users');
    }

    public function getRotulos(Request $request)
    {
        //Resquest example FILIAL_O=1&REQUI_NRO=820460&REQUI_SERIE=0

        $filial = $request->input('FILIAL_O');
        $reqNro = $request->input('REQUI_NRO');
        $reqSerie = $request->input('REQUI_SERIE');

        $myAddress = '187.22.222.19';
        $key = md5("ProjetoRotulo") . '@|@' . md5($myAddress) . '@|@' . md5(date("Ymd"));
        $parametros = 'KEY=' . $key . '&webBUSCA=' . 'REQsD' . '&' . 'FILIAL_O=' . $filial . '&REQUI_NRO=' . $reqNro . '&REQUI_SERIE=' . $reqSerie;
        $xml = json_encode(simplexml_load_file('http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?' . $parametros));
        $xmlConverted = json_decode($xml, true);
        return response($xmlConverted);
    }

    public function getPDF(Request $request)
    {
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
            '&PEDIDO_NRO=' . 500527 .
            '&SESS=afg1234567890';
        '&PEDIDO_NRO=' . ltrim(rtrim($xmlConverted['RECNO1']['NRO_PEDIDO_MOBY']));
        $xmlIMG = json_encode(simplexml_load_file('http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.php?' . $parametros));
        $xmlIMGConverted = json_decode($xmlIMG, true);
        // dd($xmlIMGConverted);
        return response($xmlIMGConverted);
    }
}
