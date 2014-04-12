<?php
class alumnos{

	var $db;
	var $id_alumno;
	var $matricula;
	var $nombre;
	var $ap_paterno;
	var $ap_materno;
	var $sexo_id;
	var $unidad_academica;
	var $archivo;

	function alumnos($db){
		$this->db=$db;
		$this->table="alumnos";
	}// Fin de constructor

	function agregar_alumno(){
		$oData = new Data($this->db);
		$sql="INSERT INTO " . $this->table . " (
		id_alumno,
		matricula,
		nombre,
		ap_paterno,
		ap_materno,
		sexo_id,
		unidad_academica,
		archivo
		) 
		VALUES (
		'',
		'" . $this->matricula . "',
		'" . $this->nombre . "',
		'" . $this->ap_paterno . "',
		'" . $this->ap_materno . "',
		'" . $this->sexo_id . "',
		'" . $this->unidad_academica . "',
		'" . $this->archivo . "'
		)";
		return $oData->add($sql); 
	}// Fin de método add


	function actualizar_alumno($id_alumno){		
		$sql="UPDATE " . $this->table . " SET 
			matricula   = '" . $this->matricula . "',
			nombre      = '" . $this->nombre . "',
			ap_paterno      = '" . $this->ap_paterno . "',
			ap_materno      = '" . $this->ap_materno . "',
			sexo_id     = '" . $this->sexo_id . "',
			unidad_academica      = '" . $this->unidad_academica . "',
			archivo     = '" . $this->archivo . "'
		WHERE id_alumno ='" . $id_alumno . "' LIMIT 1";
		$oData = new Data($this->db);
		$oData->upDate($sql);
	}// Fin de método upDate


	function obtener_alumno($id_alumno){
		$oData = new Data($this->db);
		$sql = "SELECT * FROM " . $this->table . " WHERE id_alumno = '" . $id_alumno  . "'";		
		$a_res = $oData->get($sql); // Retorna un recorset
		if( $a_res == false ){ // Si no hay resultados
		}else{ // Si encuentra resultados
			$this->matricula  = $a_res["matricula"];
			$this->nombre     = $a_res["nombre"];
			$this->ap_paterno     = $a_res["ap_paterno"];
			$this->ap_materno     = $a_res["nombre"];
			$this->sexo_id    = $a_res["sexo_id"];
			$this->unidad_academica     = $a_res["unidad_academica"];
			$this->archivo    = $a_res["archivo"];
			return true;
		}// Fin de if						
	}// Fin de método 

	function lista_alumnos(){
		$sql = "SELECT * FROM ".$this->table." 
				LEFT JOIN sexo 
				ON  alumnos.sexo_id = sexo.id_sexo";	
		$oData = new Data($this->db);		
		return $oData->getList($sql);
	}

	function eliminar_alumno($id_alumno){
		$sql = "DELETE " . $this->table . " WHERE id_alumno = '" . $id_alumno . "'";
		$oData = new Data($this->db);
		$oData->delete($sql);
	}// Fin de método delete

	function actualizar_archivo($archivo, $id_alumno){
		$sql = "UPDATE " . $this->table . "
				SET archivo = '" . $archivo . "' WHERE id_alumno = '" . $id_alumno . "'";
		$oData = new Data($this->db);
		$oData->upDate($sql);
	}// Fin de método delete
}

?>