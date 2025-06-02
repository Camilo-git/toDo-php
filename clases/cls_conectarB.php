<?php 

function conectarBD()
{
 //VARIABLES PARA CONEXION
  $servidor  ="localhost";
  $base_datos="web-me";
  $usuario   ="root";
  $clave     ="";


//SE UTILIZA PARA VALIDAR ALGO TRY - CONTROLA ERRORES
  try
  {
  	$con = new PDO("mysql:host=$servidor;dbname=$base_datos",$usuario,$clave);
  	return $con;
  }
  //SE UTILIZA PARA INDICARLE QUE HACER CUANDO OCURRA UN ERROR, EN ESTE CASO APARECERA UN MENSAJE Y DETENDRA EL PROGRAMA
  catch (Exception $e)
  {
  	echo 'No se pudo realizar la conexión a la base de datos';
  	echo '<br>';
  	echo 'Error: '.$e->getMessage();
  	exit();
  }

}
//Esto unicamente para probar la conexion, pero lo recomendable es que para iniciar la conexion se hace desde otro lugar
//$conexion = conectarBD();
//echo 'Conectado....<br>';

function desconectarBD($conexion)
{
  $conexion = null;
}

//$desconexion = desconectarBD($conexion);
//echo 'Desconectado de la base de datos....';

 ?>