<?php

// Mostramos los datos recibidos por GET y POST para depuración
echo '<pre>';
print_r($_GET);
print_r($_POST);
print_r($_REQUEST);
echo '</pre>';

// Incluimos la clase de conexión a la base de datos
include_once '../clases/cls_conectarB.php';

// Obtenemos la acción y el id de la tarea a eliminar
$accion = $_GET['accion'] ?? '';
$id = $_GET['id'] ?? '';

// Solo procedemos si la acción es 'eliminar' y el id no está vacío
if ($accion === 'eliminar' && !empty($id)) {
    // Creamos la conexión a la base de datos
    $conexion = conectarBD();

    // Preparamos la consulta para eliminar la tarea
    $sql = "DELETE FROM tareas WHERE id = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecutamos la consulta
    if ($consulta->execute()) {
        // Si la consulta se ejecuta correctamente, redirigimos a la página principal
        header('Location: ../index.php');
        exit;
    } else {
        // Si ocurre un error, mostramos un mensaje
        echo 'Error al eliminar la tarea de la base de datos';
    }

    // Cerramos la conexión
    desconectarBD($conexion);
} else {
    echo 'Acción o ID no válidos.';
}
?>