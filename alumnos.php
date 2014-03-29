<?php
require_once("conexion.php");
require_once("class/data/Data.php");
require_once("class/alumnos.php");

$alumno_obj = new alumnos($mysqli);

$array_alumnos = $alumno_obj->lista_alumnos();

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
				foreach ($array_alumnos as $alumnos) {
					echo '<tr>';
					    	echo "<td>"  . $alumnos['id_alumno'] . "</td>";
					    	echo "<td>"  . $alumnos['nombre'] . "</td>";
					    	echo "<td> " . $alumnos['matricula'] . "</td>";
					    	echo "<td> " . $alumnos['nombre_sexo'] . "</td>";
					    	echo '<td>
					    			<a class="btn" href="alumnos-editar.php?action=mostrar&id_alumno='.$alumnos['id_alumno'].'">Editar</a>
					    			<a class="btn" href="alumnos.php?action=delete&id_alumno='.$alumnos['id_alumno'].'">Eliminar</a>
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