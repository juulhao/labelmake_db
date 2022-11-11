<html>
	<head>
		<meta charset="utf-8">
		<title>AF_P1 - 315 x 60mm_ID_Rotulos_Potes_OlimpicLacre</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
		<style>
			body{
				background: url(https://delphus7.com.br/images/AF_P1.png) no-repeat;
				/* background-size: 200mm 25mm; */
				font-family: 'Asap', sans-serif;
				height: 60mm;
				margin: 0px;
				width: 315mm;
			}
			p{
				margin: 0px;
			}
			.espacamento{
				padding: 10mm 14.5mm;
			}
			.texto-laranja{
				color: #f16d00;
			}
			.texto-roxo{
				color: #611f7f;
			}
			.parte-roxa{
				color: #fff;
				font-size: 1.5mm;
				width: 37%;
				float: left;
			}
			.parte-roxa .site{
				font-size: 1.3mm;
				font-weight: 600;
				margin-top: 1.5mm;
				/* padding: 4mm 10mm 2mm 10mm;*/
			}
			.parte-um{
			    width: 25mm;
				float: left;
			}
			.parte-branca{
				/* transform: rotate(270deg);*/  
				font-size: 2mm;
				width: 55%;
				float: left;
				font-weight: 100;
			}
			.parte-branca-um{
				transform: rotate(270deg);
				width: 10%;
				margin-left: 0mm;
				font-size: 1.4mm;
			}
			.parte-branca-dois{
				width: 22%;
				float: left;
				margin-left: 5mm;
				transform: rotate(270deg);
				text-align: right;
			}
			.parte-branca-tres{
				margin-top: -13mm;
				float: left;
				width: 72%;
			}
			.parte-branca h2{
				margin: 0mm;
			}
			.parte-branca p{
				text-align: justify;
				color: #611f7f;
				margin-bottom: 1mm;
				font-size: 1.7mm;
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
					<p>Fabricado por:</p>
					<p>MPH Farmácia de Manipulação </p>
					<p>{{$enderecoRotulo}}</p>
					<p>CNPJ {{$cnpjFILIAL}}</p>
					<p>Tel. {{$DDDFilial}} {{$telefoneFilial}}</p>
					<div class="site texto-laranja">
						<p>saiba mais em:</p>
						<p>www.idmantecorp.com.br</p>
					</div>
				</div>
			</div>
			<div class="parte-branca">
				<div class="parte-branca-um"> 
					<h1 class="texto-roxo">{{$nomeProduto}}</h1>
				</div>
				<div class="parte-branca-dois"> 
					<h2 class="texto-roxo">{{$nomePaciente}}</h2>
  					<h2 class="texto-laranja">{{$nomeDoutor}}</h2>
  					<h2 class="texto-laranja">CRM: {{$crmDoutor}}</h2>
				</div>
				<div class="parte-branca-tres"> 
					<p style="text-align: right;"><span class="texto-laranja">COMPOSIÇÃO:</span></p>
					<p>
						@foreach ($formulas as $user)
						{{ $user }}
						@endforeach
					</p>
					<p style="text-align: right;"><span class="texto-laranja">POSOLOGIA:</span></p>
					<p>
						@foreach ($posologias as $user)
  							{{ $user }}
  						@endforeach
					</p>
					<p style="text-align: right;"><span class="texto-laranja">CONTÉM:</span></p>
					<p>{{$contem}}</p>
					<div class="parte-dois" style="float: right;margin-left: 12mm;">
						<p>Fab.: {{$dataFabricao}}</p>
  						<p>Val.: {{$validadeProduto}}</p>
					</div>
					<div class="parte-dois" style="float: right;">
						<p>Req.: {{$reqProduto}}</p>
  						<p>Reg.: {{$regProduto}}</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>