<?php
require_once("conexion.php");

$query_alumnos = "SELECT * FROM alumnos 
				  INNER JOIN sexo 
				  ON  alumnos.sexo_id = sexo.id_sexo";

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
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Matricula</th>
					<th>Sexo</th>
					<th>Editar</th>
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
					    		<a class="btn" href="alumnos-editar.php">Editar</a>
							<a class="btn" href="alumnos.eliminar.php">Eliminar</a>
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
