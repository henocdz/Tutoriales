<?
	require_once("bdz.php");
	
	$a = $_GET["a"];
	
	switch($a)
	{
		case "agregar":
			agregar();
		break;
		case "confirmar":
			confirmar();
		break;
		default:
			header("Location: /");
	}
	
	function agregar()
	{
		
		$bd = new bd();
		$mail = "roofdier.mx@gmail.com";//$_POST["op2"];
		$id = $bd->autoid("usuario","id_usuario",11,3);
		$insertar = $bd->insert("usuario","'$id','','$mail',NOW(),0");
	
		$bd->close();
		
		if($insertar)
		{
			$contenido = '
				Hola! Bienvenido a nuestro newsletter el siguiente paso 
				es confirmar tu suscripción, para ello debes hacer clic 
				en el siguiente enlace: 
				<br /><br /> <strong>
				<a href="http://rfdz.mx/tutoriales/newsletter?a=confirmar&id='.$id.'">http://rfdz.mx/tutoriales/newsletter?a=confirmar&id='.$id.'</a></strong>
				<br /><br />
				O bien puedes anular tu suscripción y no recibir ningun mail nuestra empresa haciendo clic en el siguiente enlace
				<br /><br/>
				<a href="http://rfdz.mx/tutoriales/newsletter?a=eliminar&id='.$id.'">http://rfdz.mx/tutoriales/newsletter?a=eliminar&id='.$id.'</a></strong>				
		';
			$status = enviar($contenido,$mail,"Bienvenido a nuestro Newsletter");
			
			if($status)
				echo "Correct";
			else
				echo "Error";			
		}
		else
			echo "Error".$bd->error;
	}
		
		function confirmar()
		{
			$bd = new bd();
			$nombre = $_POST["op2"];
			$id = $_POST["id"];
			$ver = $bd->update("UPDATE usuario SET nombre = '$nombre' WHERE id='$id'");
			
			if($ver==true)
			{
				if($bd->update("UPDATE usuario SET activo = 1 WHERE id='$id'"))
					echo "Correct";
				else
					echo "Error";
			}
			else
				echo "Error";
		}
		
		function enviar($contenido,$mail,$asunto)
		{	
			$headers = "MIME-Version:1.0;\r\n";
			$headers .= "Content-type: text/html; \r\n charset=utf-8; \r\n" ;
			$headers .= "From: no-reply@roofdier.com \r\n";
			$headers .= "To:$mail; \r\n Subject:$asunto \r\n";
			
			if(mail($mail,$asunto,$contenido,$headers))
				$status = true;
			else
				$status = false;
			
			return $status;
		}
		
	
?>