<?php
class unidades_academicas{

	var $db;
	var $id_unidad_academica;
	var $nombre_unidad_academica;

	function unidad_academica($db){
		$this->db=$db;
		$this->table="unidades_academicas";
	}// Fin de constructor
	
	function list_unidades(){
		$sql = "SELECT * FROM ".$this->table;	
		$oData = new Data($this->db);		
		return $oData->getList($sql);
	}
}

?>