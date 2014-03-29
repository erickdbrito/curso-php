<?php
class sexo{

	var $db;
	var $id_sexo;
	var $nombre_sexo;

	function sexo($db){
		$this->db=$db;
		$this->table="sexo";
	}// Fin de constructor
	
	function obtener_sexo(){
		$sql = "SELECT * FROM ".$this->table;	
		$oData = new Data($this->db);		
		return $oData->getList($sql);
	}
}

?>