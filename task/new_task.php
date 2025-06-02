<?php

//creamos un codigo que nos permite visualizar lo que recibimos por el metodo GET y POST
echo '<pre>';
print_r($_GET);
print_r($_POST);
print_r($_REQUEST);
echo '</pre>';

// incluimos la clase de conexion a la base de datos
include_once '../clases/cls_conectarB.php';
// creamos las vatiables que vamos a utilizar

$accion = $_GET['accion'] ?? '';
$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';

// creamos la conexion a la base de datos
$conexion = conectarBD();
// creamos la consulta para insertar los datos en la base de datos
$sql = "INSERT INTO tareas (titulo, descripcion) VALUES (:titulo, :descripcion)";
// preparamos la consulta
$consulta = $conexion->prepare($sql);
// vinculamos los parametros
$consulta->bindParam(':titulo', $titulo);
$consulta->bindParam(':descripcion', $descripcion);
// ejecutamos la consulta
if ($consulta->execute()) {
    // si la consulta se ejecuta correctamente, redirigimos a la pagina de tareas
    header('Location: ../index.php');
    exit;
} else {
    // si la consulta no se ejecuta correctamente, mostramos un mensaje de error
    echo 'Error al insertar los datos en la base de datos';
}

// cerramos la conexion a la base de datos
desconectarBD($conexion);

?>





