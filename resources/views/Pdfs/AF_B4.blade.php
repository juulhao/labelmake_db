<html>
	<head>
		<meta charset="utf-8">
		<title>AF_B4 - 40 x 90mm_ID_Rotulos_Bisnagas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
		<style>
			@media print {
				.pagebreak { page-break-before: always; } /* page-break-after works, as well */
			}
			body{
				/* background-size: 200mm 25mm; */
				font-family: 'Asap', sans-serif;
				height: 90mm;
				margin: 0mm;
				width: 40mm;
			}
			h1{
			    font-size: 3mm;
				text-align: right;
				margin-top: 4mm;
				margin-bottom: 4mm;
			}
			img {
				width: 40mm;
				height: 90mm;
			}
			p{
				margin: 0mm;
			}
			.espacamento{
				padding: 2mm;
				height: 90mm;
				width: 36mm;
			}
			.texto-laranja{
				color: #f16d00;
			}
			.texto-roxo{
				color: #611f7f;
			}
			.parte-roxa{
				/* background-size: 20mm 240mm; */
				color: #fff;
				font-size: 1.3mm;
				/*width: 37% */;
				height: 40mm;
				margin: 0mm;
				width: 20mm;
			}
			.parte-roxa .site{
				font-size: 1.3mm;
				font-weight: 600;
				/* padding: 4mm 10mm 2mm 10mm;*/
			}
			.site{
				margin-bottom: 3mm;
			}
			.parte-um{
			    width: 100%;
				float: left;
				margin-top: 4mm;
			}
			.parte-um p{
				margin: 0mm;
			}
			.parte-branca{
				/* transform: rotate(270deg);*/  
				font-size: 2mm;
				/*width: 55%;*/
				/* float: left; */
				/* font-weight: 100; */
				margin-top: 6mm;
			}
			.parte-branca-um{
				font-size: 1.4mm;
				float: right;
				width: 100%;
			}
			.parte-branca-dois{
				/*margin-top: -7mm;*/
				width: 100%;
				font-size: 1.3mm;
				float: right;
				text-align: right;
				margin-bottom: 4mm;
			}
			.parte-branca-tres{
				margin-top: -7mm;
				/*float: left;
				width: 53%;*/
			}
			.parte-branca h2{
				margin: 0mm;
				font-size: 2.7mm;
			}
			.parte-branca p{
				text-align: right;
				color: #611f7f;
				margin-bottom: 4mm;
				font-size: 2mm;
			}
			.parte-branca p span{
				font-weight: 600;
			}
			.parte-um p, .parte-dois p{
				margin: 0mm;
			}
			.parte-dois p{
				font-size: 1.3mm;
			}
			.parte-um p{
			    font-size: 1.5mm;
			}
			.site.texto-laranja p{
				color: #f16d00;
				font-weight: 600;
				margin: 0mm;
				font-size: 2mm;
				text-align: right;
			}
		</style>
	</head>	
	<body>
		<img src="https://delphus7.com.br/images/AF_B4.png" alt="tag">

		<div class="espacamento" style="padding-top:0mm">
			<div class="parte-branca">
				<div class="parte-branca-um" style="margin-bottom: 5mm; margin-top: -3mm">
					<h1 class="texto-roxo">{{$nomeProduto}}</h1>
				</div>
				<div class="parte-branca-dois" style="margin-top: 5mm;">
					<h2 class="texto-roxo">{{$nomePaciente}}</h2>
					<h2 class="texto-laranja">{{$nomeDoutor}}</h2>
					<h2 class="texto-laranja">CRM: {{$crmDoutor}}</h2>
				</div>
				<div class="parte-branca-tres">
					<p style="margin-top: 1mm;">
						<span class="texto-laranja">COMPOSIÇÃO:</span>
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
				</div>
				<div class="parte-dois">
					<div style="text-align: right">
						<p>Req.: {{$reqProduto}}</p>
						<p>Reg.: {{$regProduto}}</p>
						<p>Fab.: {{$dataFabricao}}</p>
						<p>Val.: {{$validadeProduto}}</p>
					</div>
				</div>

				<div class="parte-um">
					<p>Farmacêutica Resp. {{$farmaceutica}} - CRF {{$farmaceuticaCRF}}</p>
					<p>Fabricado por: MPH Farmácia de Manipulação</p>
					<p>{{$enderecoRotulo}}</p>
					<p>CNPJ {{$cnpjFILIAL}} - Tel. {{$DDDFilial}} {{$telefoneFilial}}</p>
				</div>
				<div class="site texto-laranja"  style="margin-top: 5px;">
					<p>saiba mais em:</p>
					<p>www.idmantecorp.com.br</p>
				</div>
			</div>
		</div>
	</body>
</html>