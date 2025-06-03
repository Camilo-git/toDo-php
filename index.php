<!DOCTYPE html>
<html lang="es">
<!-- <?php
echo '<pre>';
print_r($_GET);
print_r($_POST);
print_r($_REQUEST);
echo '</pre>';
?> -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/datatable/css/bootstrap.css">
    <link rel="stylesheet" href="lib/datatable/css/dataTables.bootstrap4.min.css">
</head>

<body class="container my-4">

    <!-- creamos el formulario para crear una nueva tarea -->
     <!-- validamos si la accion es editar o nueva tarea -->
      <?php
      $accion = isset($_GET['accion']) ? $_GET['accion'] : 'Nueva Tarea';
      if ($accion === 'Editar') {
          $formAction = 'task/edit_task.php';
          $buttonClass = 'btn-warning';
          $buttonText = 'Actualizar';
      } else {
          $formAction = 'task/new_task.php';
          $buttonClass = 'btn-primary';
          $buttonText = 'Guardar';
      }
      ?>
    <form class="form-group" action="<?php echo $formAction; ?>" method="post">
        <input type="hidden" name="action" value="new_task">
        <div class="container py-5">
            <?php
            // Verificamos si hay una acción de edición
            $accion = isset($_GET['accion']) ? $_GET['accion'] : 'Nueva Tarea';
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            ?>
            <h1 class="mb-4">Tareas</h1>
            <!-- recibimos la accion editar o ponemos por defecto nueva tarea -->      
            <h2 id="formTitle"> <?php echo $accion . ' ' . $id;?> </h2>      
            <div class="mb-4">
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <label for="titulo" class="form-label">Título de la tarea</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required value="<?php echo isset($_GET['titulo']) ? htmlspecialchars($_GET['titulo']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción de la tarea</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" required value="<?php echo isset($_GET['descripcion']) ? htmlspecialchars($_GET['descripcion']) : ''; ?>">
                </div>
                <!-- evaluamos si la accion es editar o nueva tarea -->
                <button type="submit" class="btn <?php echo $buttonClass; ?>"><?php echo $buttonText; ?></button>
            </div>
            <ul class="list-group" id="taskList">
                <!-- Aquí se mostrarán las tareas -->
            </ul>
        </div>
    </form>
    <!-- fin del formulario
    <!-- --------------------------------------------------------------------
 ---------------------------------------------------------------
 ---------------------- -->
    <div class="row my-3">

        <div class="col-10">
            <h3><i class="fa fa-user-circle"></i> Lista de Tareas</h3>
        </div>
       

    </div>

    <div class="row my-3">

        <div class="col-12">

            <table id="miTabla" class="table table-striped table-bordered table-hover">
                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Feche de creacion</th>
                        <th>Fecha de finalizacion</th>
                        <th>edita</th>
                        <th>borra</th>
                        <!-- th como titulos deben aver en td espacios -->

                    </tr>
                </thead>

                <tbody>

                    <!-- aqui se muestran las tareas -->
                    <?php
                     // importamos la conexion a la base de datos
                        include_once ('clases/cls_conectarB.php');
                        // creamos un objeto de la clase cls_conectarB
                        $conexion = conectarBD();
                        // preparamos la consulta
                        $sSQL = "SELECT * FROM tareas";
                        // ejecutamos la consulta
                        $datos = $conexion->query($sSQL);

                        // recorremos los datos
                        foreach ($datos as $fila) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($fila['id']) . '</td>';
                            
                            echo '<td>' . htmlspecialchars($fila['titulo']) . '</td>';
                            echo '<td>' . htmlspecialchars($fila['descripcion']) . '</td>';
                            echo '<td>'  .'</td>';
                            echo '<td>'  .'</td>';
                            echo '<td><a href="index.php?accion=Editar&id=' . $fila['id'] . '&titulo=' . $fila['titulo'] . '&descripcion=' . $fila['descripcion'] . '" class="btn btn-warning" title="Editar Tarea"><i class="fas fa-edit"></i></a></td>';
                            echo '<td><a href="task/delete_task.php?accion=eliminar&id=' . $fila['id'] . '" class="btn btn-danger" title="Borrar Tarea"><i class="fas fa-trash-alt"></i></a></td>';
                            echo '</tr>';
                        }


                     ?>
                    <!-- <tr>
                        <td>99 </td>
                        <td>primera tarea </td>
                        <td>esta tarea esta realizada manualmente</td>
                        <td>01/06/2025</td>
                        <td>02/06/2025</td>
                        <td>
                            <a href="---------------------------------" class="btn btn-warning" title="Editar Contacto">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="---------------------------------" class="btn btn-danger" title="Borrar Contacto">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr> -->






                </tbody>




            </table>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="lib/bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="lib/bootstrap/js/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/datatable/js/jquery.dataTables.min.js"></script>
    <script src="lib/datatable/js/dataTables.bootstrap4.min.js"></script>
    <script src="lib/fontawesome/js/all.js"></script>
</body>

</html>


<script>
    $('#miTabla').DataTable({
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ elementos",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Ningún dato disponible en esta tabla",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
</script>