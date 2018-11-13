<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
      		<span class="right"><input type="button" id="logout" name="logout" value="Logout"></span>
      	<?php 
include "ParametrosBD.php";

		$email= $_GET['mail'];
 $conexion=mysqli_connect($servidor,$usuario,$password,$basededatos);
$sql= "SELECT imagen,nombre FROM usuarios WHERE email='$email'";
$resultado= mysqli_query($conexion,$sql);

while($imprimir=mysqli_fetch_array($resultado)){

echo $imprimir['nombre'];
?> &nbsp;&nbsp;

<?php
echo $imprimir['imagen'];
}
?>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
   
<nav class='main' id='n1' role='navigation'>
	
<?php
				
				echo"
				<span><a href='layout.php?mail=$email'>Inicio</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='preguntas.php?mail=$email'>Insertar Pregunta</a></spam>";
				?>
				<?php
				
				echo"
				<span><a href='VerPreguntasConFoto.php?mail=$email'>Ver Preguntas</a></spam>";
				?>
				<?php
				
				echo"
				<span><a href='VerPreguntasXML.php?mail=$email'>Ver Preguntas XML</a></spam>";
				?>
			<?php
				
				echo"
				<span><a href='GestionPreguntas.php?mail=$email'>Gestionar Preguntas</a></spam>";
				?>
<?php
				
				echo"
				<span><a href='creditos.php?mail=$email'>Creditos</a></spam>";
				?>
				
			
			
	</nav>
    <section class="main" id="s1">
    
    <h3> Gestionar Preguntas</h3>
    
    <div>
    	Usuarios Conectados
    	<fieldset id="UsuariosConectados"></fieldset>
    </div>  
     <div>
    	TOTAL PREGUNTAS / TUYAS
    	<fieldset id="numeroPreguntas">Cargando...</fieldset>
    </div>

	<div>
		
<center> <input type="button" id="insertarpregunta" onclick="InsertQuestion()" value="Insertar Pregunta">
<input type="button" id="verpregunta" onclick="VerPreguntas()" value="Ver Preguntas"></center> 

<fieldset>

<form id="fpreguntas" name="fpreguntas" method="POST" enctype="multipart/form-data" action="InsertarPreguntaConFoto.php?mail=<?php echo $email; ?>" style="background-color: white; text-align: left;">
	
	Email*:<input type="text" name="email" id="email" class="entrada" placeholder="email123@ikasle.ehu.eus" required pattern="[a-z]{3,200}[0-9]{3}@ikasle.ehu+\.eus$" value="<?php echo $email; ?>" readonly><br>
	Enunciado de la pregunta*: <input type="text" name="enunciado" id="enunciado" class="entrada"required minlength="10"><br>
	Respuesta Correcta*: <input type="text" name="respcorrecta" id="respcorrecta" class="entrada"required><br>
	Respuesta Incorrecta*: <input type="text" name="respincorrecta1" id="respincorrecta1" class="entrada"required><br>
	Respuesta Incorrecta*: <input type="text" name="respincorrecta2" id="respincorrecta2" class="entrada"required><br>
	Respuesta Incorrecta*: <input type="text" name="respincorrecta3" id="respincorrecta3" class="entrada"required><br>
	<hr>
	Complejidad(0..5)*: <input type="number" name="complejidad" id="complejidad" min="0" max="5" class="entrada "required><br>
	Tema(subject)*: <input type="text" name="tema" id="tema" class="entrada"required><br>


</form>   </fieldset>

	</div>

<div id=infopreguntas>



<script>
function VerPreguntas(){
		$.ajax({
		url: 'verpreguntasbymail.php?mail=<?php echo $email ?>',

		beforeSend:function(){
			
			$('#infopreguntas').html('<div><img src="img/loading.gif" width="80"/></div>')},


		success:function(datos){


		$('#infopreguntas').fadeIn().html(datos);},
		error:function(){
			$('#infopreguntas').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		}


	function InsertQuestion(){

		var enunciadoform = document.getElementById("enunciado").value;
	 	var respcorrectaform = document.getElementById("respcorrecta").value;
	 	var respin1form = document.getElementById("respincorrecta1").value;
	 	var respin2form = document.getElementById("respincorrecta2").value;
	 	var respin3form = document.getElementById("respincorrecta3").value;
	 	var complejidadform = document.getElementById("complejidad").value;
	 	var temaform = document.getElementById("tema").value;

	xmlhttp= new XMLHttpRequest();
	xmlhttp.onreadystatechange= function()
	{

	if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("infopreguntas").innerHTML= xmlhttp.responseText

	}

	}
	xmlhttp.open("GET",'InsertarPreguntaxmlbd.php?mail=<?php echo $email?>&enunciado='+enunciadoform+'.&respcorrecta='+respcorrectaform+'.&respincorrecta1='+respin1form+'.&respincorrecta2='+respin2form+'.&respincorrecta3='+respin3form+'.&complejidad='+complejidadform+
	 		'&tema='+temaform+'.',true);
	xmlhttp.send();
VerPreguntas();
	
}


function ContarPreguntas(){
		$.ajax({
		url: 'ContarNumPreguntas.php?mail=<?php echo $email ?>',

		beforeSend:function(){
			
			$('#numeroPreguntas').html('<div><img src="img/loading.gif" width="30"/></div>')},


		success:function(datos){


		$('#numeroPreguntas').fadeIn().html(datos);},
		error:function(){
			$('#numeroPreguntas').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		}

function UsuariosConectados(){
		$.ajax({
		url: 'UsuariosConectados.php?mail=<?php echo $email ?>',

		beforeSend:function(){
			
			$('#UsuariosConectados') },


		success:function(datos){


		$('#UsuariosConectados').fadeIn().html(datos);},
		error:function(){
			$('#UsuariosConectados').fadeIn().html('<p><strong>El servidor parece que no responde</p>');
		}
			});
		}



var tmp = setInterval(function(){ UsuariosConectados() }, 3000);
var tmpp = setInterval(function(){ ContarPreguntas() }, 18000);

</script>

</div>
<div id=inform></div>
	  </section>
	<footer class='main' id='f1'>
		<a href='https://github.com/asierblaz/LabAJAX'>Link GITHUB</a>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
	$("#logout").click(function() {	
	
	alert("Gracias por jugar a quiz.");

		$(location).attr('href', 'logout.php');
	});
	
</script>
</div>
</body>
</html>
