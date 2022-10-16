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
        $xml = json_encode(simplexml_load_file('http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v4.php?' . $parametros));

        return response(json_decode($xml, true));
    }
}
