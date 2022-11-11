<html>
	<head>
		<meta charset="utf-8">
		<title>AF_AIR2 - 95 x 105_ID_Rótulos_PTG Airless</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
		<style>
			body{
				background: url(https://delphus7.com.br/images/AF_AIR2.png) no-repeat;
				/* background-size: 140mm 40mm; */
				font-family: 'Asap', sans-serif;
				height: 105mm;
				margin: 0px;
				width: 95mm;
			}
			p{
				margin: 0px;
			}
			.espacamento{
				padding: 53mm 4.5mm;
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
			.texto-girado{
				transform: rotate(270deg);
				margin-top: 3mm;
				margin-left: -1mm;
				float: left;
			}
			.texto-normal{
				float: left;
				width: 100%;
				margin-top: 10mm;
			}
			.parte-branca{
				font-size: 1.5mm;
				font-weight: 600;
				padding: 0mm 0mm 0mm 0mm;
				margin-right: 0mm;
				margin-top: -50mm;
				width: 50%;
				float: right;
				text-align: right;
				font-weight: 100;
			}
			.parte-branca h2{
				margin: 0mm;
			}
			.parte-branca .texto-normal > p{
				margin-top: 2mm;
			}
			.parte-branca .parte-um > p{
				float: right;
			}
			.parte-branca p{
				text-align: justify;
				color: #611f7f;
				/* margin-top: 2mm; */
				font-size: 1.7mm;
			}
			.parte-dois{
			    /*padding-top: 10mm;*/
			}
			.parte-branca p span{
				font-weight: 600;
			}
		</style>
	</head>	
	<body>
		<div class="espacamento">
			<div class="parte-roxa">
			</div>
			<div class="parte-branca">
				<div class="texto-girado">
					<h1 class="texto-roxo">{{$nomeProduto}}</h1>
					<h2 class="texto-roxo">{{$nomePaciente}}</h2>
					<h2 class="texto-laranja">{{$nomeDoutor}}</h2>
					<h2 class="texto-laranja">CRM: {{$crmDoutor}}</h2>
				</div>
				<div class="texto-normal">
					<p style="margin-top: 0mm;"><span class="texto-laranja">COMPOSIÇÃO:</span> 
						@foreach ($formulas as $user)
						{{ $user }}
					@endforeach
					</p>
					<p>
						<span class="texto-laranja">POSOLOGIA:</span>
						@foreach ($posologias as $user)
							{{ $user }}
						@endforeach
					</p>
					<p><span class="texto-laranja">CONTÉM:</span> {{$contem}}</p>
					<div style="width: 70%;float: left;margin-top: 2mm;margin-left: -5mm;">
						<p>Req.: {{$reqProduto}}</p>
						<p>Reg.: {{$regProduto}}</p>
					</div>
					<div style="width: 50%;float: left;margin-top: 2mm;">
						<p>Fab.: {{$dataFabricao}}</p>
						<p>Val.: {{$validadeProduto}}</p>
					</div>
					<div class="site texto-laranja" style="    margin-top: 9mm; margin-right: 10mm; margin-left: -8mm;>
						<b style="color: #f16d00">saiba mais em:</b>
						<b style="color: #f16d00">www.idmantecorp.com.br</b>
					</div>
					<div class="parte-um" style="margin-left: -15mm; margin-top: 5mm;">
						<p>Farmacêutica Resp. {{$farmaceutica}} - CRF {{$farmaceuticaCRF}}</p>
						<p>Fabricado por: MPH Farmácia de Manipulação</p>
						<p>{{$enderecoRotulo}}</p>
						<p>CNPJ {{$cnpjFILIAL}} - Tel. {{$DDDFilial}} {{$telefoneFilial}}</p>
					</div>
				<div>
			</div>
		</div>
	</body>
</html>