<?php
require_once("conexion.php");
require_once("class/data/Data.php");
require_once("class/alumnos.php");
require_once("class/computadoras.php");
require_once("class/registros.php");

$computadora_obj = new computadoras($mysqli);
$alumno_obj		 = new alumnos($mysqli);
$registro_obj    = new registro_laboratorio($mysqli);


$action = $_GET["action"];
$matricula = $_POST["matricula"];

$app_office 	= $_POST["app_office"];
$app_internet 	= $_POST["app_internet"];
$app_otra 		= $_POST["app_otra"];

if (!empty($matricula)) {

	$alumno_obj->obtener_alumno_por_matricula($matricula);
	
	$id_alumno = $alumno_obj->id;
	$nombre_alumno = $alumno_obj->nombre;
	$ap_paterno = $alumno_obj->ap_paterno;
	$ap_materno = $alumno_obj->ap_materno;
	$unidad_academica = $alumno_obj->unidad_academica;

	$array_computadoras_activas = $computadora_obj->list_computadoras_activas();

	foreach ($array_computadoras_activas as $computadora) {
		if($computadora_obj->verificar_equipo_disponible($computadora["id_computadora"]))
		{
			$registro_obj->id_alumno 		= $id_alumno;
			$registro_obj->id_computadora 	= $computadora["id_computadora"];
			$registro_obj->app_office 		= $app_office;
			$registro_obj->app_internet 	= $app_internet;
			$registro_obj->app_otra 		= $app_otra;
			$registro_obj->agregar_registro();
		}else{

		}
	}		

	$id_computadora = $_GET["id_computadora"];

	if (!empty($id_computadora)) {
		
		if($computadora_obj->eliminar_computadora($id_computadora))
			$mensaje = "Registro eliminado";
		else
			$mensaje = "Ocurrio un error";
	}
} 

/**
  * Header file
  */
 require_once("template/header.php");
?>

 <div class="container-fluid">
      <div class="row">
 		<?php
        /**
         * Siderbar File
         */
         require_once("template/sidebar.php") 
         ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
        <h1 class="page-header">Ingrese su matricula</h1>
		
		<div class="well">
			<form class="form-vertical" method="post"  >
				<label>Matricula</label>
				<input name="matricula">
				<button type="submit" class="btn">Asignar Maquina </button>
			</form>
		</div>
		
	</div>
<?php
    /**
     * Footer
     */
require_once("template/footer.php");