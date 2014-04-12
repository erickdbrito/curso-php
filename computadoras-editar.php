<?php
require_once("conexion.php");
require_once("class/data/Data.php");
require_once("class/computadoras.php");

$computadora_obj = new computadoras($mysqli);

/**
 * Mostrar información del computadora
 * @var [type]
 */
$action = $_GET["action"];
if (!empty($action) && $action == "mostrar") {
	
	$id_computadora = $_GET["id_computadora"];

	if (!empty($id_computadora)) {
		
		if($computadora_obj->obtener_computadora($id_computadora))
		{
			$nombre 	= $computadora_obj->nombre;
			$descripcion= $computadora_obj->descripcion;
			$estatus 	= $computadora_obj->estatus;
		}else{
			$mensaje = "Ocurrio un error";
			$nombre 	= "";
			$descripcion 	= "";
			$estatus 	= "";
		}
	}
}

/**
 * Modificar información del computadora
 */
$action = $_POST["action"];
if (!empty($action) && $action == "actualizar") {
	
	$id_computadora 	= $_POST["id_computadora"];
	$computadora_obj->nombre 	= $nombre 	= $_POST["nombre"];
	$computadora_obj->descripcion 	= $descripcion 	= $_POST["descripcion"];
	$computadora_obj->estatus 	= $estatus 	= $_POST["estatus"];

	if (empty($id_computadora)) {
		# añadir computadora
		$id_computadora = $computadora_obj->agregar_computadora();
	}else{
		$computadora_obj->actualizar_computadora($id_computadora);
	}
	
	header("Location: computadoras.php");
}


$action = $_GET["action"];

if (!empty($action) && $action == "add") {
	$id_computadora = "";
	$nombre 	= "";
	$descripcion 	= "";
	$estatus 	= "";
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
        <h1>computadoras</h1>
        <?php if(!empty($mensaje)){ ?>
		<div class="label"><?php echo $mensaje; ?></div>
		<?php } ?>
		<form  action="" method="POST" name="form_computadoras" enctype="multipart/form-data">
			<input type="hidden" name="action" value="actualizar">
			<input type="hidden" name="id_computadora" value="<?php echo $id_computadora?>">

			<div class="form-group">
				<label>Nombre del computadoras</label>
				<input class="form-control"  type="text" name="nombre" value="<?php echo $nombre?>">
			</div>
			<div class="form-group">
				<label>Descripcion</label>
				<input class="form-control" type="text" name="descripcion" value="<?php echo $descripcion?>">
			</div>
			
			<div class="control-group">
				<label class="control-label">Estatus</label>
				<div class="controls">
				   	<label class="checkbox">
			           	<input type="checkbox" <?php if($estatus != "0") echo 'checked="checked"' ?> name="estatus" value="1">Activo<br>
				   	</label>
			    </div> 
			</div>

			<div class="form-group">
				<button type="submit">Guardar Información</button>
			</div>
		</form>

	</div>
<?php
    /**
     * Footer
     */
    require_once("template/footer.php");