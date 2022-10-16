<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">

    <title>WebService-Almofariz2FCerta</title>
    <style type="text/css">
        <!--
        .style1 {
            font-family: "Courier New", Courier, monospace;
            font-size: 12px;
        }
        -->
    </style>

</head>

<?

//ini_set( 'default_charset' , 'ISO-8859-1' ); 

//ini_set( 'default_charset' , 'UTF-8' ); 


?>


<body>
    <form action="<?php print $PHP_SELF; ?>" method="post" name="form1" id="form1">
        <label>Objeto de Pesquisa
            <input name="txtPesquisa" type="text" id="txtPesquisa" value="<?php print $_POST['txtPesquisa'] ?>" />
        </label>
        &nbsp;&nbsp;&nbsp;
        <label>Tipo de Retorno:
            <input type="radio" name="TpRetorno" id="TpRetorno" value="Curl/XML" checked="checked" />Curl/XML
            <input type="radio" name="TpRetorno" id="TpRetorno" value="DOM/XML" />simpleXML
            <input type="radio" name="TpRetorno" id="TpRetorno" value="JSon" />JSon
        </label>
        <br /><br />
        <label>Parâmetros da Pesquisa
            <input name="txtParametros" type="text" id="txtParametros" value="<?php print $_POST['txtParametros'] ?>" size="100" maxlength="1000" />
        </label>
        <label>
            <input type="submit" name="Submit" value="Submit" />
        </label>
        <?

        print '<div class="style1"><br><br>' . $_SERVER['REMOTE_ADDR'] . ' : ' . $_SERVER['SERVER_ADDR'] . "<br>---------------------------------------------------------------------------------------------------------<br>";


        $key = md5("ProjetoRotulo") . '@|@' . md5($_SERVER['SERVER_ADDR']) . '@|@' . md5(date("Ymd"));
        //		$key = md5("ProjetoRotulo") .'@|@'. $_SERVER['REMOTE_ADDR']      .'@|@'. md5(date("Ymd"));

        $parametros = 'KEY=' . $key . '&webBUSCA=' . $_POST['txtPesquisa'] . '&' . $_POST['txtParametros'];

        list($usec, $sec) = explode(' ', microtime());
        $usec = str_replace("0.", ".", $usec);
        print 'Início..: ' . date('H:i:s', $sec) . $usec;
        print '<br>';

        if ($_POST["TpRetorno"] == "Curl/XML") {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?' . $parametros);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $transaction = curl_exec($ch);
            curl_close($ch);

            list($usec1, $sec1) = explode(' ', microtime());
            $usec1 = str_replace("0.", ".", $usec1);
            print 'Término.: ' . date('H:i:s', $sec1) . $usec1 . '<br>&nbsp;<br>';

            print $transaction;
        }

        if ($_POST["TpRetorno"] == "DOM/XML") {
            $xml = simplexml_load_file('http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?' . $parametros);

            list($usec1, $sec1) = explode(' ', microtime());
            $usec1 = str_replace("0.", ".", $usec1);
            print 'Término.: ' . date('H:i:s', $sec1) . $usec1 . '<br>&nbsp;<br>';

            print_r($xml);
        }

        if ($_POST["TpRetorno"] == "JSon") {
            // ENDEREÇO DO ENDPOINT PRA BUSCAR OS XMLS
            //$xml = json_encode(simplexml_load_file('http://ias3.hospedagemdesites.ws/ws.rotulos/api/wBuscaMooca.v2.php?' . $parametros));

            // ENDEREÇO DA PAGINA, QUE NO CASO NÃO ENCONTRARÁ AS INFORMAÇÕES DO XML
            //$xml = json_encode(simplexml_load_file('https://ias3.websiteseguro.com/ws.rotulos/api/testa.v4.php?' . $parametros));

            list($usec1, $sec1) = explode(' ', microtime());
            $usec1 = str_replace("0.", ".", $usec1);
            print 'Término.: ' . date('H:i:s', $sec1) . $usec1 . '<br>&nbsp;<br>';
            print $xml . "<br><br>";
            print_r(json_decode($xml, true));
        }

        ?>
    </form>
    <p>&nbsp;</p>
</body>

</html>