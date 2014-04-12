<?php
require_once("conexion.php");
require_once("class/data/Data.php");
require_once("class/alumnos.php");
require_once("class/computadoras.php");
require_once("class/registros.php");

$computadora_obj = new computadoras($mysqli);
$alumno_obj		 = new alumnos($mysqli);
$registro_obj    = new registro_laboratorio($mysqli);
$pagina = $alta;

if(!empty($_POST["matricula"]))
	$matricula = $_POST["matricula"];

if (!empty($matricula)) {

	if($alumno_obj->obtener_alumno_por_matricula($matricula))
	{

		$id_alumno 			= $alumno_obj->id_alumno;
		$nombre_alumno 		= $alumno_obj->nombre;
		$ap_paterno 		= $alumno_obj->ap_paterno;
		$ap_materno 		= $alumno_obj->ap_materno;
		$unidad_academica 	= $alumno_obj->unidad_academica;

		if($registro_obj->verificar_alumno($id_alumno))
		{
			$app_office 	= $_POST["app_office"];
			$app_internet 	= $_POST["app_internet"];
			$app_linux 		= $_POST["app_linux"];
			$app_otra 		= $_POST["app_otra"];


			$array_computadoras_activas = $computadora_obj->list_computadoras_activas();

			foreach ($array_computadoras_activas as $computadora) {
				if($registro_obj->verificar_equipo_disponible($computadora["id_computadora"]))
				{
					$registro_obj->id_alumno 		= $id_alumno;
					$registro_obj->id_computadora 	= $computadora["id_computadora"];
					$registro_obj->app_office 		= $app_office;
					$registro_obj->app_internet 	= $app_internet;
					$registro_obj->app_linux	 	= $app_linux;
					$registro_obj->app_otra 		= $app_otra;
					$registro_obj->agregar_registro();
					
					$mensaje = "<div class='well'>
								 <strong>".$nombre_alumno." ".$ap_paterno." ".$ap_materno."</strong>
							Favor usar el equipo: ".$computadora["nombre"]."</div>";
				}else{
					$mensaje = "<div class='alert'>No hay equipos diponibles</div>";
				}
			}
		}else{
			$mensaje = $mensaje = "<div class='well'>
								   <strong>".$nombre_alumno." ".$ap_paterno." ".$ap_materno."
 								   se encuentra usando un equipo </strong></div>";
		}		
	}else{
		$mensaje = "<div class='alert'>Alumno no encontrado</div>";
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
         
         <div><?php if(!empty($mensaje)) echo $mensaje; ?></div>

		       
        <h1 class="page-header">Ingrese su matricula</h1>
		
		<div class="well">
			<form class="form-vertical" method="post"  >
				<label>Matricula</label>
				<input name="matricula">
				<label>Office</label>
				<input type="checkbox" name="app_office">
				<label>Internet</label>
				<input type="checkbox" name="app_internet">
				<label>Otra</label>
				<input type="checkbox" name="app_otra">
				<label>Linux</label>
				<input type="checkbox" name="app_linux">
				<button type="submit" class="btn">Asignar Maquina </button>
			</form>
		</div>
		
	</div>
<?php
    /**
     * Footer
     */
require_once("template/footer.php");