<?php
/**
 * Archivo clase de computadoras
 */
class computadoras{

	var $nombre;
	var $fecha_nacimiento;
	var $sexo;
	var $curp;
	var $direccion;

	function declarar_computadoras($nombre, $fecha_nacimiento, $sexo, $curp, $direccion)
	{
		$this->nombre 			= $nombre;
		$this->fecha_nacimiento = $fecha_nacimiento;
		$this->sexo 			= $sexo;
		$this->curp 			= $curp;
		$this->direccion 		= $direccion;
	}

	function obtener_datos() 
	{
		$datos = array(
			    nombre  			=> $this->nombre,
			    fecha_nacimiento 	=> $this->fecha_nacimiento,
			    sexo 				=> $this->sexo,
			    curp 				=> $this->curp,
			    direccion 			=> $this->direccion
			    );
		return $datos;
	} //termina medoto

} // termina clase