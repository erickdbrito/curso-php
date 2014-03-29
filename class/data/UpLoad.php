<?php 
/* 
+----------------------------------------------------------------------+
 | PHP version 5                                         
 +----------------------------------------------------------------------+
 | Clase: UpLoad                                                     
 |   Atributos:
 |		extenciones:array		-Arreglo con extenciones validas
 |		resultados:string         -Resultados de operaciones       
 |		maxSize:int                  -Tamaño maximo para carga de archivos
 |		fileSize:string               -Tamño de archivo cargado
 |  Metodos:					                            			  
 |      new(void):String
 | 		setExtencionPermitida($extencion:String):void 		-Inserta una extención permitida de archivo
 |		cargaArchivo($file:String,$dir:String):boolean			-Carga un archivo                                                
 | Descripcion: Permite cargar archivos de cualquier extencion
 |              
 +----------------------------------------------------------------------+
 | Version: 0.4                                         
 | Fecha:19-Ene-10
 +----------------------------------------------------------------------+
*/
class UpLoad{

	var $extenciones;
	var $resultados;
	var $nameFile;
	var $maxSize = 50000000; // 50 MB
	var $fileSize;
	
	function UpLoad()
	{
		$this->extenciones = array();
//		array_push($this->extenciones,"");
	}// Fin de constructor
	
	function setExtencionPermitida($extencion){
		/* Descripcion: Agrega una nueva extencion pemitida
		    debe ser un nombre de extencion
			Fecha Actualizacion:	 28-Abr-09	     
		*/
		array_push($this->extenciones,$extencion);		
	}

	function cargaArchivo($file,$dir){
	/*
		Descripción: Funcion que realiza rutinas necesarias para cargar archivos
		Parametros:
			$file: Nombre del archivo a importar
			$dir: Directorio del servidor donde se cargara el archivo
		Retorno:
			Boolean: TRUE en caso de que se cargue correctamente. FLASE en caso de que no cumpla alguno de las politicas	
		Actuallización: 28-Jul-09
	*/
//			echo "<br>". gettype($file);
			$uploaddir = $dir; // Asigna directorio destino
//			echo "<br>Ruta destino: " . $dir;
//				//Carga máxima probada 2 Mb.
//				$strPath=$_POST["pathImagen"];			
//				$b=0;		
				if(!isset($file['name'])){ //Si no existe variable
					//Si no existe variable
//					echo "<br>Error en función upLoad: No se econtro el nombre del archivo";
				}else{
					//Si existe
					$Nombrearchivo = $file['name']; // Asigna el nombre de archivo a cargar
//					echo "<br>Nombre archivo a cargar:" . $Nombrearchivo;
				}// Fin de if si se lleno variable
				$tipo_archivo = $file['type']; // obtiene el tipo de archivo
//				echo "<br>Tipo de Archivo:" . $tipo_archivo;
				$tamano_archivo =  $file['size']; //obtiene el tamaño del archivo en bytes
//				echo "<br>Tamaño: " . $tamano_archivo;			

				if($this->nameFile==""){ //Si no se asigno nombre  en el parametro de la clase, toma el mismo nombre del archivo					
					$uploaddir .= "/" . $Nombrearchivo;
				}else{ // Toma el nombre que se asigno
					$uploaddir .= "/" . $this->nameFile;
				}// Fin de if

				
				//*********************************************************		
				
		//		if($tipo_archivo="image/pjpeg"){
		//				//$mensaje=$mensaje. "<br>El tipo de imágen es jpg si podrá subir el archivo.";
	//		}
				// Verificando extención
	 			$extencion = explode(".",$Nombrearchivo);
				$ext = strtolower($extencion[count($extencion)-1]); // Obtiene extencion de archivo a ser cargado
//				echo "<br>extencion:" . $ext;
				// Calcula tamaño de archivo--------------------------
//				$size = $tamano_archivo; 
//				$units = array(' bytes', ' Kb.', ' Mb.', ' Gb.', ' Tb.'); 
//				for($i = 0; $size > 1024; $i++) { $size /= 1024; }
				$this->fileSize = self::getSizeString($tamano_archivo);
//				echo "<br>Tamaño original:" . $tamano_archivo . " Bytes";
//				echo "<br>Tamaño maximo permitido:" .   $this->maxSize . " Bytes";
//				echo "<br>Tamaño:". $this->fileSize;			
				// Fin de calculo de tamaño de archivo---------------								
				$id_a = array_search($ext,$this->extenciones); // Obtiene el id del arreglo donde viene la lista de extenciones permitidas
//				echo "<br>id arreglo extencion:" . $id_a;
				if(strtolower($this->extenciones[$id_a])==$ext){ // Compara la extencion del archivo con la encontrada
//						echo "<br>Si se encontro la extencion";
						// Subiendo archivo
						if ($tamano_archivo < $this->maxSize) { 
//							echo "<br>Ruta Final a cargar:" . $uploaddir;	
							try{							
								if(move_uploaded_file($file['tmp_name'],$uploaddir) == false){
								 	throw new Exception('La carpeta destino en el servidor no existe o no tiene permisos de escritura');
								}else{ // Si se carga con exito
									$this->resultados = "Archivo cargado en el servidor con exito";
									return true;										
							 	}// Fin de if
							}catch(Exception $e){
								$this->resultados = $e->getMessage();
								return false;
							}																				
						}else{ 	// Si el tamaño supera el permitido
							$this->resultados =  "El peso del archivo " . $this->fileSize  . " supera el permitido " . self::getSizeString($this->maxSize) . ".  No se cargara el archivo" ;
							return false;				
						}// Fin de if tamaño de archivo									
				}else{				
						$this->resultados =  "Extencion de archivo no permitida: '" . $ext ."' No se cargara el archivo";				
						return false;				
				}// Fin de if
				
	}// Fun de Funcion

	function getSizeString($sizeBytes){
		// Calcula tamaño de archivo--------------------------
		$size = $sizeBytes; 
		$units = array(' bytes', ' Kb.', ' Mb.', ' Gb.', ' Tb.'); 
		for($i = 0; $size > 1024; $i++) { $size /= 1024; }
		return round($size, 2).$units[$i];
	}// Fin de funcion
	
}// Fin de clase
?>