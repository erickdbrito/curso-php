<?php
require_once("conexion.php");
require_once("class/data/Data.php");
require_once("class/computadoras.php");

$computadora_obj = new computadoras($mysqli);

$array_computadoras = $computadora_obj->lista_computadoras();

$action = $_GET["action"];

if (!empty($action) && $action == "delete") {
	
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
          
          <h1 class="page-header">Computadoras</h1>
		
		<div>
			<a href="computadoras-editar.php?action=add" class="btn">Añadir computadora</a>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Estatus</th>
					<th>Editar</th>
				</tr>
			</thead>
			<tbody>
				<?php    
				foreach ($array_computadoras as $computadoras) {
					echo '<tr>';
					    	echo "<td>"  . $computadoras['id_computadora'] . "</td>";
					    	echo "<td>"  . $computadoras['nombre'] . "</td>";
					    	echo "<td> " . $computadoras['descripcion'] . "</td>";
					    	echo "<td> " . $computadoras['estatus'] . "</td>";
					    	echo '<td>
					    			<a class="btn" href="computadoras-editar.php?action=mostrar&id_computadora='.$computadoras['id_computadora'].'">Editar</a>
					    			<a class="btn" href="computadoras.php?action=delete&id_computadora='.$computadoras['id_computadora'].'">Eliminar</a>
					    		  </td>';
					    echo '</tr>';
				 } 
				?>
			</tbody>
		</table>
		
	</div>
<?php
    /**
     * Footer
     */
require_once("template/footer.php");