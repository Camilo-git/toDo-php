<?php


// Visualizamos los datos recibidos
echo '<pre>';
print_r($_GET);
print_r($_POST);
print_r($_REQUEST);
echo '</pre>';

// Incluimos la clase de conexión a la base de datos
include_once '../clases/cls_conectarB.php';

// Obtenemos los datos necesarios
$id = $_GET['id'] ?? $_POST['id'] ?? '';
$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';

// Validamos que tengamos el ID y los datos necesarios
if ($id && $titulo && $descripcion) {
    // Creamos la conexión a la base de datos
    $conexion = conectarBD();

    // Creamos la consulta para actualizar los datos
    $sql = "UPDATE tareas SET titulo = :titulo, descripcion = :descripcion WHERE id = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(':titulo', $titulo);
    $consulta->bindParam(':descripcion', $descripcion);
    $consulta->bindParam(':id', $id);

    // Ejecutamos la consulta
    if ($consulta->execute()) {
        // Redirigimos si la actualización fue exitosa
        header('Location: ../index.php');
        exit;
    } else {
        echo 'Error al actualizar los datos en la base de datos';
    }

    // Cerramos la conexión
    desconectarBD($conexion);
} else {
    echo 'Faltan datos para actualizar la tarea';
}

?>