<?php
include_once("cls_conectarB.php");
class Auxiliar
{
   //SE DEFINEN LAS VARIABLES PARA MANEJAR TODOS LOS CAMPOS DE LA CLASE
   private $cedula;
   private $nombre;
   private $celular;
   private $correo;
   private $direccion;

   // METODO CONSTRUCTOR DE LA CLASE
   public function __construct()
   {
      // SE DEFINEN LAS VARIABLES PARA MANEJAR TODOS LOS CAMPOS DE LA CLASE
      $this->cedula = 0;
      $this->nombre = "";
      $this->celular = "";
      $this->correo = "";
      $this->direccion = "";
   }

   //METODO PARA CARGAR TODOS LOS DATOS
   function cargarDatos($cedula, $nombre, $celular, $correo, $direccion)
   {
      $this->cedula = $cedula;
      $this->nombre = $nombre;
      $this->celular = $celular;
      $this->correo = $correo;
      $this->direccion = $direccion;
   }

   //SE DEFINEN LOS METODOS SET Y GET
   function setcedula($cedula)
   {
      $this->cedula = $cedula;
   }

   function setNombre($nombre)
   {
      $this->nombre = $nombre;
   }

   function setcelular($celular)
   {
      $this->celular = $celular;
   }

   function setcorreo($correo)
   {
      $this->correo = $correo;
   }

   function setdireccion($direccion)
   {
      $this->direccion = $direccion;
   }


   function getcedula()
   {
      return $this->cedula;
   }

   function getNombre()
   {
      return $this->nombre;
   }

   function getcelular()
   {
      return $this->celular;
   }

   function getcorreo()
   {
      return $this->correo;
   }

   function getdireccion()
   {
      return $this->direccion;
   }



   //METODOS CRU CREATE,READ,UPDATE,DELETE
   /*--------------------------------------------------------------------------
	 Function insertar()
	 Objetivo: Permite el ingreso de registros nuevos a la tabla de Contactos
	 Retorno: valor booleano 
	 1: true -> La operaciòn se ejecutò con èxito
	 2: false -> La operaciòn no se pudo ejecutar
	 --------------------------------------------------------------------------*/
   public function insertar()
   {
      //variables de trabajo
      $resultado = false;
      $filas = 0;
      //creamos la conexion
      $conexion = conectarBD();
      // creamos la variable con el QUERY -> orden para la base de datos
      $sSQL = "INSERT INTO tbl_auxiliares VALUES (?,?,?,?,?)";
      //PrepareStatement es el que transporta los datos a la base de datos y los trae de vuelta
      try {
         $pst = $conexion->prepare($sSQL);
         $pst->bindParam(1, $this->cedula);
         $pst->bindParam(2, $this->nombre);
         $pst->bindParam(3, $this->celular);
         $pst->bindParam(4, $this->correo);
         $pst->bindParam(5, $this->direccion);
         //se envia a ejecutar la conexion
         $filas = $pst->execute();
         $resultado = ($filas > 0) ? true : false;
      } catch (Exception $e) {
         echo "No se pudo realizar la conexión a la Base de Datos";
         echo "<br>";
         echo "Error:" . $e->getMessage();
         $resultado = false;
      }
      return $resultado;
   } //cierra el método insertar
   /*--------------------------------------------------------------------------
	 Function eliminar()
	 Objetivo: Permite eliminar registros de la tabla de Contactos
	 Retorno: valor booleano 
	 1: true -> La operaciòn se ejecutò con èxito
	 2: false -> La operaciòn no se pudo ejecutar
	 --------------------------------------------------------------------------*/
   public function eliminar()
   {
      //variables de trabajo
      $resultado = false;
      $filas = 0;
      //creamos la conexion
      $conexion = conectarBD();
      // creamos la variable con el QUERY -> orden para la base de datos
      $sSQL = "DELETE FROM tbl_auxiliares WHERE cedula = ?";
      //PrepareStatement es el que transporta los datos a la base de datos y los trae de vuelta
      try {
         $pst = $conexion->prepare($sSQL);
         $pst->bindParam(1, $this->cedula);
         //se envia a ejecutar la conexion
         $filas = $pst->execute();
         $resultado = ($filas > 0) ? true : false;
      } catch (Exception $e) {
         echo "No se pudo realizar la conexión a la Base de Datos";
         echo "<br>";
         echo "Error:" . $e->getMessage();
         $resultado = false;
      }
      return $resultado;
   } //cierra el método eliminar
   /*--------------------------------------------------------------------------
	 Function modificar()
	 Objetivo: Permite editar los registros de un contacto
	 Retorno: valor booleano 
	 1: true -> La operaciòn se ejecutò con èxito
	 2: false -> La operaciòn no se pudo ejecutar
	 --------------------------------------------------------------------------*/
   public function modificar()
   {
      //variables de trabajo
      $resultado = false;
      $filas = 0;
      //creamos la conexion
      $conexion = conectarBD();
      // creamos la variable con el QUERY -> orden para la base de datos
      $sSQL = "UPDATE tbl_auxiliares SET
           cedula    = ?,
           nombre    = ?,
           celular = ?,
           correo  = ?,
           direccion    = ?
           WHERE  cedula = ?";
      //PrepareStatement es el que transporta los datos a la base de datos y los trae de vuelta
      try {
         $pst = $conexion->prepare($sSQL);
         $pst->bindParam(1, $this->cedula);
         $pst->bindParam(2, $this->nombre);
         $pst->bindParam(3, $this->celular);
         $pst->bindParam(4, $this->correo);
         $pst->bindParam(5, $this->direccion);
         $pst->bindParam(6, $this->cedula);
         //se envia a ejecutar la conexion
         $filas = $pst->execute();
         $resultado = ($filas > 0) ? true : false;
      } catch (Exception $e) {
         echo "No se pudo realizar la conexión a la Base de Datos";
         echo "<br>";
         echo "Error:" . $e->getMessage();
         $resultado = false;
      }
      return $resultado;
   } //cierra el método modificar
}//cierra la clase

//para probar el método insertar
/*$contacto = new Contacto();
$contacto->cargarDatos(0,"Sofia Angulo","Barrio El Dorado","322777123","sofiaang@gmail.es",2,"1974-05-20");
//ahora se grabaran los datos
if ($contacto->insertar())
{
	echo 'El contacto se insertó correctamente';
} else 
{
	echo 'El contacto no se pudo insertar correctamente';
}*/

//para probar el método eliminar
// $contacto = new Contacto();
// $contacto->cargarDatos(7,"","","","","","");
// //ahora se grabaran los datos
// if ($contacto->eliminar())
// {
// 	echo 'El contacto se eliminó correctamente';
// } else 
// {
// 	echo 'El contacto no se pudo eliminar correctamente';
// }

//para probar el método modificar
/*$contacto = new Contacto();
$contacto->cargarDatos(6,"Andrea Munoz","Barrio Capusigra","3121456105","andreamur@hotmail.es",2,"1975-01-06");
//ahora se grabaran los datos
if ($contacto->modificar())
{
	echo 'El contacto se editó correctamente';
} else 
{
	echo 'El contacto no se pudo editar correctamente';
}*/
