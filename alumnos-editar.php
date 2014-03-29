<?php
require_once("conexion.php");
require_once("class/data/Data.php");
require_once("class/alumnos.php");
require_once("class/sexo.php");
require_once("class/data/UpLoad.php");

$alumno_obj = new alumnos($mysqli);
$sexo_obj 	= new sexo($mysqli);
$upload 	= new UpLoad();

$array_sexo = $sexo_obj->obtener_sexo();

/**
 * Mostrar información del alumno
 * @var [type]
 */
$action = $_GET["action"];
if (!empty($action) && $action == "mostrar") {
	
	$id_alumno = $_GET["id_alumno"];

	if (!empty($id_alumno)) {
		
		if($alumno_obj->obtener_alumno($id_alumno))
		{
			$nombre 	= $alumno_obj->nombre;
			$matricula 	= $alumno_obj->matricula;
			$sexo_id 	= $alumno_obj->sexo_id;
			$estado 	= $alumno_obj->estado;
			$archivo 	= $alumno_obj->archivo;
		}else{
			$mensaje = "Ocurrio un error";
			$nombre 	= "";
			$matricula 	= "";
			$sexo_id 	= "";
			$estado 	= "";
			$archivo 	= "";
		}
	}
}

/**
 * Modificar información del alumno
 */
$action = $_POST["action"];
if (!empty($action) && $action == "actualizar") {
	
	$id_alumno 	= $_POST["id_alumno"];
	$alumno_obj->nombre 	= $nombre 	= $_POST["nombre"];
	$alumno_obj->matricula 	= $matricula 	= $_POST["matricula"];
	$alumno_obj->sexo_id 	= $sexo_id 	= $_POST["sexo_id"];
	$alumno_obj->estado 	= $estado 	= $_POST["estado"];
	$alumno_obj->archivo 	= $archivo 	= $_POST["archivo"];

	if (empty($id_alumno)) {
		# añadir alumno

		$id_alumno = $alumno_obj->agregar_alumno();

	}else{

		$alumno_obj->actualizar_alumno($id_alumno);

		
	}
	if($_FILES['fileAlumno']['name'] != "")
	{
		$ruta_archivo	  = "files/"; 

		$upload->setExtencionPermitida("jpg");
		$upload->setExtencionPermitida("png");
		$upload->setExtencionPermitida("jpeg");
		$upload->setExtencionPermitida("pdf");
		$upload->maxSize = 5072000;
		  	  
		$obtener_ext = explode(".", $_FILES['fileAlumno']['name']);
		$extension = ".".$obtener_ext[1];
		$upload->nameFile =  $nameFile = md5($id_alumno).$extension;

	    
		if($upload->cargaArchivo($_FILES['fileAlumno'], $ruta_archivo))
		{
			$alumno_obj->actualizar_archivo($nameFile, $id_alumno);
			$mensaje = "El archivo se subio correctamente";
		}else{
			$mensaje = '<div class="">El archivo '. $_FILES['fileAlumno']['name']. ' no se cargo correctamente. <strong>Error Message['.$upload->resultados.']</strong></div>';			
		}

		header("Location: alumnos.php");
	}
}


$action = $_GET["action"];

if (!empty($action) && $action == "add") {
	$id_alumno = "";
	$nombre 	= "";
	$matricula 	= "";
	$sexo_id 	= "";
	$estado 	= "";
	$archivo 	= "";
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
		<form  action="" method="POST" name="form_alumnos" enctype="multipart/form-data">
			<input type="hidden" name="action" value="actualizar">
			<input type="hidden" name="archivo" value="<?php echo $archivo?>">
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
				<select class="form-control" name="sexo_id">
					<?php
					foreach ($array_sexo as $sexo) {
						$id_sexo 		= $sexo["id_sexo"];
						$nombre_sexo 	= $sexo["nombre_sexo"];
						if($sexo_id == $id_sexo)
							$sexo_actual = 'selected="selected"';
						else
							$sexo_actual = '';

						echo '<option '.$sexo_actual.' value="'.$id_sexo.'" >'.$nombre_sexo.'</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Estado</label>
				<input class="form-control" type="text" name="estado" value="<?php echo $estado?>">
			</div>
			<div class="form-group">
				<label>archivo</label>
				<?php
				if (!empty($archivo)) {
					$path_image = "files/".$archivo;
					echo '<a href="'.$path_image.'" >Ver archivo</a>';
				}
				?>
				<input type="file" name="fileAlumno" class="input-file"> 
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