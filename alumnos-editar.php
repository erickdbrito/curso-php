<?php
require_once("conexion.php");
/**
 * Mostrar información del alumno
 * @var [type]
 */
$action = $_GET["action"];
if (!empty($action) && $action == "mostrar") {
	
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
			$foto 		= $alumno["foto"];
		}else{
			$mensaje = "Ocurrio un error";
			$nombre 	= "";
			$matricula 	= "";
			$sexo_id 	= "";
			$estado 	= "";
			$foto 		= "";
		}
	}
}

/**
 * Modificar información del alumno
 */
$action = $_POST["action"];
if (!empty($action) && $action == "actualizar") {
	$id_alumno 	= $_POST["id_alumno"];
	$nombre 	= $_POST["nombre"];
	$matricula 	= $_POST["matricula"];
	$sexo_id 	= $_POST["sexo_id"];
	$estado 	= $_POST["estado"];
	$foto 		= $_POST["foto"];

	if (empty($id_alumno)) {
		# añadir alumno
		
		$query_add = "INSERT INTO alumnos 
				  VALUES(
				  	'',
				  	'$nombre',
				    '$matricula',
				    '$sexo_id',
				    '$estado',
				    '$foto') ";
		if($mysqli->query($query_add))
			$mensaje = "Registro añadido";
		else
			$mensaje = "Ocurrio un error al actualizar";

		header("Location: alumnos.php");
		exit;
	}else{
		# Actualizar alumno
		$query_actualizar = "UPDATE alumnos SET (
							 nombre = '$nombre',
							 matricula = '$matricula',
							 sexo_id = '$sexo_id',
							 estado = '$estado',
							 foto = '$foto')
							 WHERE id_alumno = $id_alumno";

		if($mysqli->query($query_actualizar))
			$mensaje = "Registro actualizado";
		else
			$mensaje = "Ocurrio un error al actualizar";

		header("Location: alumnos.php");
		exit;
	}

}


$action = $_GET["action"];

if (!empty($action) && $action == "add") {
	$id_alumno = "";
	$nombre 	= "";
	$matricula 	= "";
	$sexo_id 	= "";
	$estado 	= "";
	$foto 		= "";
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
        <?php if(!empty($mensaje)){ ?>
		<div class="label"><?php echo $mensaje; ?></div>
		<?php } ?>
		<form  action="" method="POST" name="form_alumnos">
			<input type="hidden" name="action" value="actualizar">
			<input type="hidden" name="foto" value="<?php echo $foto?>">
			<input type="hidden" name="id_alumno" value="<?php echo $id_alumno?>">

			<div class="form-group">
				<label>Nombre del alumnos</label>
				<input class="form-control"  type="text" name="nombre" value="<?php echo $nombre?>">
			</div>
			<div class="form-group">
				<label>Matricula</label>
				<input class="form-control" type="text" name="matricula" value="<?php echo $matricula?>">
			</div>
			<div class="form-group">
				<label>Sexo id</label>
				<input class="form-control" type="number" name="sexo_id" value="<?php echo $sexo_id?>">
			</div>
			<div class="form-group">
				<label>Estado</label>
				<input class="form-control" type="text" name="estado" value="<?php echo $estado?>">
			</div>
			<div class="form-group">
				<label>Foto</label>
				<?php
				if (!empty($foto)) {
					$path_image = "files/imagenes/".$foto;
					echo '<img src="'.$path_image.'" width="200" height="100">';
				}
				?>
				<input type="file" name="file-img"> 
			</div>
			<div class="form-group">
				<button type="submit">Guardar Informacion</button>
			</div>
		</form>

		
	</div>
 <?php
    /**
     * Footer
     */
    require_once("template/footer.php");