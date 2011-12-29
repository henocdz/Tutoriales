<?
	require_once("bdz.php");	
	$a = $_GET["a"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title><?echo getTitle($a);?></title>
	
	<style type="text/css">
		html,body
		{
			font-family: Arial;
			font-size: 21px;
			margin: 0;
			padding: 0;
		}
		
		#formsub
		{
			background: #006fe5;
			box-shadow: #000 5px 5px 30px;
			border-radius: 5px;
			display:block;
			height: 150px;
			margin: 14% auto;
			padding: 5px;
			width: 600px;
		}
		
		#formsub label
		{
			cursor: pointer;
			display:block;
			margin: 10px auto;
			text-align: center;
			width: 80%;		
		}
		
		#formsub input[type="text"]
		{
			cursor: text;
			display:block;
			font-size: 1.5em;
			margin: 10px auto;
			text-align: left;
			width: 90%;
		}
		
		#formsub input[type="button"]
		{
			cursor: pointer;
			background: #e8ba00;
			border-radius: 5px;
			display:block;
			height: 35px;
			margin: 15px auto;
			outline: 0;
			border: 0;
			width: 125px;
		}
		
		#formsub input[type="button"]:hover
		{
			background: #cc0b0b;
		}
		
		form
		{
			width: 100%;
		}
		
		#status
		{
			text-align: center;
			font-size: 15px;
			margin: 15px auto;
			width: 450px;
		}
	</style>
	
	
	<?echo getJS($a);?>
</head>
<body>
	<?echo getBody($a);?>
</body>
</html>

<?

function getTitle($a)
{
$id = $_GET["id"];

if(!(isset($id)) || strlen($id)<11 || strlen($id)>11)
	unset($a);

if($a=="confirmar")
	$title = "Confirma tu Suscripción";
elseif($a=="eliminar")
	$title = "¡Adiós!";
else
	$title = "¡Bienvenido!";

return $title;
}


function getBody($a)
{
$bd = new bd();
$id = $_GET["id"];
$ver = $bd->verify1("usuario","id_usuario",$id,1);

if(!(isset($id)) || strlen($id)<11 || strlen($id)>11 || !($ver))
	unset($a);

if($a=="confirmar")
	$body = '
		<div id="formsub">
			<form name="usuario">
				<label for="nombre">Como te decimos?</label>
				<input type="text" name="op2" id="nombre" placeholder="Nombre,Apodo,etc..." autocomplete="off"/>
				<div id="status">
					<input type="button" value="Confirmar"/>
				</div>
			</form>
		</div>				
	';
elseif($a=="eliminar")
{
	$del = $bd->delete("usuario","id_usuario",$id,1);
	
	if($del && $ver)
		$mssg = "SUSCRIPCIÓN CANCELADA! <br /> Lamentamos que te vayas, pero recuerda que siempre puedes volver! :)";
	else
		$mssg = "Oops! Ha ocurrido un error. Intenta recargando la página";
	
	
	$body = '
		<div id="formsub" style="height: 50px; font-size: 15px;">
			<label style="cursor:default;">'.$mssg.'</label>
		</div>
	';			
}
else
	$body = '
		<div id="formsub">
			<form name="usuario">
				<label for="mail">ESCRIBE TU EMAIL</label>
				<input type="text" name="op2" id="mail" placeholder="No mordemos..." autocomplete="off"/>
				<div id="status">
					<input type="button" value="SUSCRIBIRME"/>
				</div>
			</form>
		</div>				
	';
	
	$bd->close();
	
return $body;			
}

function getJS($a)
{

$bd = new bd();
$id = $_GET["id"];
$ver = $bd->verify1("usuario","id_usuario",$id,1);

if(!(isset($id)) || strlen($id)<11 || strlen($id)>11 || !($ver) || (!($a=="eliminar") && !($a=="confirmar")))
	$a="agregar";
		
$js = '
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function (){
			var a = "'.$a.'";
			var id = "'.$id.'";
			
			$('."'".'#formsub input[type="button"]'."'".').click(function (){
			
				$.ajax({
					beforeSend: function (){
						$("#status").html("<img src='."'".'loading.gif'."'".' width='."'".'30'."'".'/>");
					},
					url: "newsletter.php?a="+a,
					type: "POST",
					data: {id:id,op2:document.usuario.op2.value},
					success: function(data)
					{
						
						if(data=="Correct")
						{
							if(a=="confirmar")
								$("#status").html("<label><img src='."'".'ok.png'."'".' width=30 style='."'".'vertical-align:middle;'."'".'/>Suscripción Activada! Pronto Recibiras noticias de nosotros!</label>");
							else
								$("#status").html("<label><img src='."'".'ok.png'."'".' width=30 style='."'".'vertical-align:middle;'."'".'/>Listo! Checa tu correo (Y Quizá SPAM)</label>");
						}
						else
						{
							$("#status").html("<label><img src='."'".'error.png'."'".' width=30 style='."'".'vertical-align:middle;'."'".'/>Hubo un Error!</label>");
						}
						
					}
				});					
			});
		});
	</script>
';

return $js;
}


















?>