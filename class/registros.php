<?php
/**
 * Archivo clase de registro_laboratorio
 */
class registro_laboratorio{

	var $id;
	var $id_alumno;
	var $id_computadora;
	var $fecha_inicio;
	var $fecha_termino;
	var $app_office;
	var $app_internet;
	var $app_linux;
	var $app_otra;
	var $estatus_maquina;

	function registro_laboratorio($db){
		$this->db=$db;
		$this->table="registro_laboratorio";
	}// Fin de constructor

	function agregar_registro(){
		$oData = new Data($this->db);
		$sql="INSERT INTO " . $this->table . " (
		id,
		id_alumno,
		id_computadora,
		fecha_inicio,
		app_office,
		app_internet,
		app_linux,
		app_otra,
		estatus_maquina
		) 
		VALUES (
		'',
		'" . $this->id_alumno . "',
		'" . $this->id_computadora . "',
		'" . date("Y-m-d h:i:s") . "',
		'" . $this->app_office . "',
		'" . $this->app_internet . "',
		'" . $this->app_linux . "',
		'" . $this->app_otra . "',
		'1'
		)";
		return $oData->add($sql); 
	}// Fin de método add


	function liberar_equipo($id_registro){		
		$sql="UPDATE " . $this->table . " SET 
			fecha_termino   = '" . date("Y-m-d h:i:s") . "',
			estatus_maquina = '0'
			WHERE id = '" . $id_registro . "' LIMIT 1";
		$oData = new Data($this->db);
		$oData->upDate($sql);
	}// Fin de método upDate


	function obtener_registros(){
		$sql = "SELECT CONCAT_WS( alumnos.nombre, alumnos.ap_paterno, alumnos.ap_materno ) AS nombre_completo, matricula, fecha_inicio, computadoras.nombre AS nombre_equipo, app_office, app_internet, app_linux, app_otra
				FROM  `registro_laboratorio` 
				INNER JOIN alumnos ON registro_laboratorio.id_alumno = alumnos.id_alumno
				INNER JOIN computadoras ON computadoras.id_computadora = registro_laboratorio.id_computadora";	
		$oData = new Data($this->db);		
		return $oData->getList($sql);
	}


	function eliminar_registros($id_registro){
		$sql = "DELETE " . $this->table . " WHERE id = '" . $id_registro . "'";
		$oData = new Data($this->db);
		$oData->delete($sql);
	}// Fin de método delete

	function verificar_equipo_disponible($id_computadora){
		$oData = new Data($this->db);
		$sql = "SELECT * FROM registro_laboratorio
				WHERE id_computadora = $id_computadora AND estatus_maquina = '0'";
		$a_res = $oData->get($sql); // Retorna un recorset
		if( $a_res == false ){ // Si no hay resultados
			return TRUE;
		}else{ // Si encuentra resultados
			return FALSE;
		}// Fin de if
	}

	function verificar_alumno($id_alumno){
		$oData = new Data($this->db);
		$sql = "SELECT * FROM registro_laboratorio
				WHERE id_alumno = $id_alumno AND estatus_maquina = '1'";
		$a_res = $oData->get($sql); // Retorna un recorset
		if( $a_res == false ){ // Si no hay resultados
			return TRUE;
		}else{ // Si encuentra resultados
			$this->id	= $a_res["id"];
			return FALSE;
		}// Fin de if
	}
} // termina clase