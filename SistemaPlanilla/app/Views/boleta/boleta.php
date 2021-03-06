<body>

	<!-- contenedor -->
	<main id="contenedor">
	<div id="imported_csv_data"></div>
		<!-- formulario -->
		<section class="formulario">
			
			<!-- -->
			<header>
				<h1>Boletas de pago</h1>
			</header>
			<!-- -->
			
			<!-- -->
			<section>
				<form  id="formulario" enctype="multipart/form-data" method="get">
					<p><img src="img/file.png" alt="" class="imagen"></p>
					<h2>Ingrese codigo de planilla</h2>
					<p><input type="text" name="codigo" id="codigo" onkeyup="Buscar()"  /></p>
					
				</form>

			</section>
			<!-- -->

		</section>
		<!-- ./formulario -->

	</main>
	<!-- ./contenedor -->


</body>

<br>
<br>

<div id="cambio"></div>




<script src="<?= base_url() ?>/js/boleta/boleta.js"></script>

<style type="text/css">
body{
	background: rgba(127,145,165,1);
	background: -moz-linear-gradient(top, rgba(127,145,165,1) 0%, rgba(113,132,149,1) 29%, rgba(127,145,165,1) 50%, rgba(108,127,144,1) 100%);
	background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(127,145,165,1)), color-stop(29%, rgba(113,132,149,1)), color-stop(50%, rgba(127,145,165,1)), color-stop(100%, rgba(108,127,144,1)));
	background: -webkit-linear-gradient(top, rgba(127,145,165,1) 0%, rgba(113,132,149,1) 29%, rgba(127,145,165,1) 50%, rgba(108,127,144,1) 100%);
	background: -o-linear-gradient(top, rgba(127,145,165,1) 0%, rgba(113,132,149,1) 29%, rgba(127,145,165,1) 50%, rgba(108,127,144,1) 100%);
	background: -ms-linear-gradient(top, rgba(127,145,165,1) 0%, rgba(113,132,149,1) 29%, rgba(127,145,165,1) 50%, rgba(108,127,144,1) 100%);
	background: linear-gradient(to bottom, rgba(127,145,165,1) 0%, rgba(113,132,149,1) 29%, rgba(127,145,165,1) 50%, rgba(108,127,144,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7f91a5', endColorstr='#6c7f90', GradientType=0 );
	margin:0;
}

html,body{
	width: 100%;
	height: 100%;
}

.error input, input.error{
    border: 1px solid red !important;
    border-radius: 1px;
    -webkit-border-radius: 1px;
    -moz-border-radius: 1px;
    -o-border-radius: 1px;
    -ms-border-radius: 1px;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;    
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -moz-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -ms-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

#contenedor{
	height: auto;
	margin: auto;
    width: 100%;
}
#contenedor section.formulario{
	height: auto;
	margin: 70px auto 0 auto;
	width: 60%;
}
#contenedor section.formulario header {
	background-color: #18C0A9;
	color: #fff;
	height: auto;
	margin: auto;
	padding: 30px;
}
#contenedor section.formulario header h1{
	font-size: 40px;
	text-align: center;
}
#contenedor section.formulario section{
	background: #fff;
    padding: 15px;	
	height: auto;
}
#contenedor section.formulario section h2{
    border-bottom: #2ECD71 2px solid;
    font-size: 30px;
    margin: 0 auto;
    padding-bottom: 10px;
    text-align: center;
    width: 45%;
}
#contenedor section.formulario section p{
	text-align: center;
}
#contenedor section.formulario section p img.imagen{
	display: block;
	margin: 0 auto;
}
#contenedor section.formulario section p input.separar_boton{
	background: #2ECD71;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-o-border-radius: 5px;
	-ms-border-radius: 5px;
	border: 0;
	color: #fff;
    font-size: 18px;
	margin-top: 20px;
	padding: 10px;
}

</style>



