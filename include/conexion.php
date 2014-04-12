<?php
error_reporting(E_ERROR );
ini_set('display_errors','Off');

$DBServer = 'localhost'; // e.g 'localhost'
$DBUser   = 'root';
$DBPass   = 'root';
$DBName   = 'curso_web';

$conexion_db = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// Verificar conexión
if ($conexion_db->connect_error) {
  trigger_error('Error al conectar a la base de datos: '  . $conexion_db->connect_error, E_USER_ERROR);
}