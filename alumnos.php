<?php
require_once("conexion.php");

$query_alumnos = "SELECT * FROM alumnos 
				  LEFT JOIN sexo 
				  ON  alumnos.sexo_id = sexo.id_sexo";

$action = $_GET["action"];

if (!empty($action) && $action == "delete") {
	
	$id_alumno = $_GET["id_alumno"];

	if (!empty($id_alumno)) {
		$query_eliminar = "DELETE FROM alumnos WHERE id_alumno = $id_alumno";

		if($mysqli->query($query_eliminar))
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
          <h1 class="page-header">Alumnos</h1>
		
		<div>
			<a href="alumnos-editar.php?action=add" class="btn">Añadir alumno</a>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Matricula</th>
					<th>Sexo</th>
					<th>Editar</th>
				</tr>
			</thead>
			<tbody>
				<?php    
				if($resultado = $mysqli->query($query_alumnos))
				{
					echo "Orden del conjunto de resultados...\n";
					//$resultado->data_seek(0);

					while ($fila = $resultado->fetch_assoc()) {
						//print_r($fila);
						echo '<tr>';
					    	echo "<td>"  . $fila['id_alumno'] . "</td>";
					    	echo "<td>"  . $fila['nombre'] . "</td>";
					    	echo "<td> " . $fila['matricula'] . "</td>";
					    	echo "<td> " . $fila['nombre_sexo'] . "</td>";
					    	echo '<td>
					    			<a class="btn" href="alumnos-editar.php?action=mostrar&id_alumno='.$fila['id_alumno'].'">Editar</a>
					    			<a class="btn" href="alumnos.php?action=delete&id_alumno='.$fila['id_alumno'].'">Eliminar</a>
					    		  </td>';
					    echo '</tr>';
					}
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