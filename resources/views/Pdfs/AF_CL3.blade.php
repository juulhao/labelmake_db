<html>
	<head>
		<meta charset="utf-8">
		<title>AF_CL3 - 170 x 110mm_ID_Rotulos_OnixBlack</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
		<style>
			body{
				background: url(https://delphus7.com.br/images/AF_CL3.png) no-repeat;
				background-size: 170mm 110mm;
				font-family: 'Asap', sans-serif;
				height: 110mm;
				margin: 0px;
				width: 170mm;
			}
			p{
				margin: 0px;
			}
			.espacamento{
				padding: 38mm 0mm 0mm 17mm;
			}
			.texto-laranja{
				color: #f16d00;
			}
			.texto-roxo{
				color: #611f7f;
			}
			.parte-roxa{
				color: #fff;
				font-size: 1.4mm;
			}
			.parte-roxa .site{
				font-size: 1.7mm;
				font-weight: 600;
				margin-top: 2mm;
				/*padding: 4mm 10mm 2mm 10mm;*/
			}
			.parte-branca{
				transform: rotate(270deg);
				font-size: 1.5mm;
				font-weight: 600;
				padding: 0mm 0mm 0mm 0mm;
				margin-right: 8mm;
				margin-top: -39mm;
				width: 41%;
				float: right;
				text-align: right;
				font-weight: 100;
			}
			.parte-branca h2{
				margin: 0mm;
			}
			.parte-branca p{
				text-align: justify;
				color: #611f7f;
				margin-top: 2mm;
				font-size: 2mm;
			}
			.parte-dois{
			    padding-top: 10mm;
			}
			.parte-branca p span{
				font-weight: 600;
			}
		</style>
	</head>	
	<body>
		<div class="espacamento">
			<div class="parte-roxa">
				<div class="parte-um">
					<p>Farmacêutica Resp.:</p>
					<p>{{$farmaceutica}}</p>
					<p style="margin-bottom: 1mm;">CRF {{$farmaceuticaCRF}}</p>
					<p>Fabricado por: MPH</p>
					<p>{{$enderecoRotulo}}</p>
					<p>CNPJ {{$cnpjFILIAL}}</p>
					<p>Tel. {{$DDDFilial}} {{$telefoneFilial}}</p>
				</div>
				<div class="site texto-laranja">
					<p>saiba mais em:</p>
					<p>www.idmantecorp.com.br</p>
				</div>
				<div class="parte-dois">
					<p>Req.: {{$reqProduto}}</p>
					<p>Reg.: {{$regProduto}}</p>
					<p>Fab.: {{$dataFabricao}}</p>
					<p>Val.: {{$validadeProduto}}</p>
				</div>
			</div>
			<div class="parte-branca">
				<h1 class="texto-roxo">{{$nomeProduto}}</h1>
				<h2 class="texto-roxo">{{$nomePaciente}}</h2>
				<h2 class="texto-laranja">{{$nomeDoutor}}</h2>
				<h2 class="texto-laranja">CRM: {{$crmDoutor}}</h2>
				<p style="margin-top: 3mm;"><span class="texto-laranja">COMPOSIÇÃO:</span> 
					@foreach ($formulas as $user)
						{{ $user }}
					@endforeach
				</p>
				<p><span class="texto-laranja">POSOLOGIA:</span>
					@foreach ($posologias as $user)
  							{{ $user }}
  						@endforeach
				</p>
				<p><span class="texto-laranja">CONTÉM:</span>
					{{$contem}}
				</p>
			</div>
		</div>
	</body>
</html>