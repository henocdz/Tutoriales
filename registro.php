<?

$id_usuario = generador(5,false,false,true,false);
$nombreUsuario = $_POST["nombreUsuario"];
$mail = $_POST["mail"];
$contrasenna = $_POST["pwd"];
$sexo = $_POST["sx"];

$conexion = mysql_connect ("localhost","root","root");
mysql_select_db("tuteam",$conexion);

$sql_usuarioCheca = "SELECT * FROM usuario WHERE nombre_usuario = '$nombreUsuario'";
$sql_mailCheca = "SELECT * FROM usuario WHERE email = '$mail'";
$sql_registro = "INSERT INTO usuario VALUES ($id_usuario,'$nombreUsuario','$mail','$contrasenna',$sexo)";


if(mysql_num_rows(mysql_query($sql_usuarioCheca)) > 0)
	echo "Este usuario ya existe";
elseif (mysql_num_rows(mysql_query($sql_mailCheca)) > 0)
	echo "Este mail ya existe";
elseif (mysql_query($sql_registro))
	echo "Ususario registrado correctamente";
else 
	echo "Error cr�tico.";



function generador($longitud,$letras_min,$letras_may,$numeros,$simbolos)
{
	//Evaluamos [$variable?] si queremos letras min�sculas; Si s� agregamos la letras min�sculas
	// Si NO [:'';] , no agregamos nada.
	$variacteres = $letras_min?'abdefghijklmnopqrstuvwxyz':'';
	//Hacemos lo mismo para letras may�sculas,numeros y simbolos
	$variacteres .= $letras_may?'ABDCEFGHIJKLMNOPQRSTUVWXYZ':'';
	$variacteres .= $numeros?'0123456789':''; //NOTA: En el tutorial puse mal esta variable debe ser -numeros- y no -numero-.
	$variacteres .= $simbolos?'!#$%&/()?��':'';
	
	//Inicializamos variable $i y $clv
	$i = 0;
	$clv = '';
	
	//repetimos el codigo segun la longitud
	while($i<$longitud)
		{
			//Generamos un numero aleatorio
			$numrad = rand(0,strlen($variacteres)-1);
			//Sacamos el la letra al azar
			//La funci�n -substr()- se compone de substr($variable,posici�n_inicio,longitud de sub cadena);
			$clv .= substr($variacteres,$numrad,1);
			//Aumentamos a $i en 1 cada que entramos al while
			$i++;
		}
		
		//Mostramos la cadena generada por medio de -echo-
	return $clv;
}

?>