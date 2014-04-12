<?php
require_once("conexion.php");
require_once("class/data/Data.php");
require_once("class/registros.php");

$registros = new registro_laboratorio($mysqli);

$array_registros = $registros->obtener_registros();


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
        <div class="col-sm-12 col-md-12 col-md-offset-2 main">
          
          <h1 class="page-header">registros</h1>
		
		<div>
			<a class="btn btn-success" href="registros-editar.php?action=add" class="btn">Añadir computadora</a>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Matricula</th>
					<th>Nombre</th>
					<th>Equipo</th>
					<th>Última uso</th>
					<th>Office</th>
					<th>Internet</th>
					<th>Linux</th>
					<th>Otra</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if (count($array_registros)) 
				{	$count = 0;
					foreach ($array_registros as $registros) {
						$count++;
						echo '<tr>';
						    	echo "<td>"  . $count . "</td>";
						    	echo "<td>"  . $registros['matricula'] . "</td>";
						    	echo "<td>"  . $registros['nombre_completo'] . "</td>";
						    	echo "<td> " . $registros['nombre_equipo'] . "</td>";
						    	echo "<td> " . $registros['fecha_inicio'] . "</td>";
						    	echo "<td> " . $registros['app_office'] . "</td>";
						    	echo "<td> " . $registros['app_internet'] . "</td>";
						    	echo "<td> " . $registros['app_linux'] . "</td>";
						    	echo "<td> " . $registros['app_otra'] . "</td>";
						    echo '</tr>';
					 } 
				} //if	   
				?>
			</tbody>
		</table>
		
	</div>
<?php
    /**
     * Footer
     */
require_once("template/footer.php");