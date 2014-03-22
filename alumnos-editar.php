<?php
require_once("conexion.php");

$query_alumnos = "SELECT * FROM alumnos 
				  INNER JOIN sexo 
				  ON  alumnos.sexo_id = sexo.id_sexo";


$action = $_GET["action"];

if (!empty($action) && $action == "modificar") {
	
	$id_alumno = $_GET["id_alumno"];

	if (!empty($id_alumno)) {
		$query_modificar = "SELECT nombre, matricula, sexo_id, estado 
						   FROM alumnos WHERE id_alumno = $id_alumno";

		if($actualizar =  $mysqli->query($query_modificar))
		{
			$alumno = $actualizar->fetch_assoc();

			$nombre 	= $alumno["nombre"];
			$matricula 	= $alumno["matricula"];
			$sexo_id 	= $alumno["sexo_id"];
			$estado 	= $alumno["estado"];
		}else
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
        <div class="col-sm-8 col-md-8 col-md-offset-2 main">
        <h1>Alumnos</h1>
		
		<form class="form-horizontal" action="" method="POST" name="form_alumnos">
			<label>Nombre del alumnos</label>
			<input type="text" name="nombre" value="<?php echo $nombre?>">

			<label>Matricula</label>
			<input type="text" name="matricula" value="<?php echo $matricula?>">

			<label>Sexo id</label>
			<input type="number" name="sexo_id" value="<?php echo $sexo_id?>">

			<label>Estado</label>
			<input type="text" name="estado" value="<?php echo $estado?>">
		</form>

		
	</div>
 <?php
    /**
     * Footer
     */
    require_once("template/footer.php");