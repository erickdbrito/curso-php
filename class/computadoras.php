<?php
/**
 * Archivo clase de computadoras
 */
class computadoras{

	var $id_computadora;
	var $nombre;
	var $descripcion;
	var $estatus;

	function computadoras($db){
		$this->db=$db;
		$this->table="computadoras";
	}// Fin de constructor

	function agregar_computadora(){
		$oData = new Data($this->db);
		$sql="INSERT INTO " . $this->table . " (
		id_computadora,
		descripcion,
		nombre,
		estatus
		) 
		VALUES (
		'',
		'" . $this->descripcion . "',
		'" . $this->nombre . "',
		'" . $this->estatus . "'
		)";
		return $oData->add($sql); 
	}// Fin de método add


	function actualizar_computadora($id_computadora){		
		$sql="UPDATE " . $this->table . " SET 
			descripcion   = '" . $this->descripcion . "',
			nombre      = '" . $this->nombre . "',
			estatus      = '" . $this->estatus . "'
		WHERE id_computadora ='" . $id_computadora . "' LIMIT 1";
		$oData = new Data($this->db);
		$oData->upDate($sql);
	}// Fin de método upDate


	function obtener_computadora($id_computadora){
		$oData = new Data($this->db);
		$sql = "SELECT * FROM " . $this->table . " WHERE id_computadora = '" . $id_computadora  . "'";		
		$a_res = $oData->get($sql); // Retorna un recorset
		if( $a_res == false ){ // Si no hay resultados
		}else{ // Si encuentra resultados
			$this->descripcion  = $a_res["descripcion"];
			$this->nombre     = $a_res["nombre"];
			$this->estatus     = $a_res["estatus"];
			return true;
		}// Fin de if						
	}// Fin de método 

	function lista_computadoras(){
		$sql = "SELECT * FROM ".$this->table;	
		$oData = new Data($this->db);		
		return $oData->getList($sql);
	}

	function eliminar_computadora($id_computadora){
		$sql = "DELETE " . $this->table . " WHERE id_computadora = '" . $id_computadora . "'";
		$oData = new Data($this->db);
		$oData->delete($sql);
	}// Fin de método delete


} // termina clase