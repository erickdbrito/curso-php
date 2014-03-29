<?php 

/**
 *----------------------------------------------------------------------+
 * PHP version 5                                         
 *----------------------------------------------------------------------+
 * Authors: Erick Brito                                  
 *----------------------------------------------------------------------+
 * Class: Data                                                       
 *  Atributos: $mysqli                                                       
 *  Metodos:					                            			  
 *       add(void):String                                               
 *       get(void):String                                               
 *       upDate(void):String                                               
 *       getList(void):String                                               
 *       delete(void):String                                               
 * Descripcion: Data methods for excecute SQL Sentence into the database
 *              
 *----------------------------------------------------------------------+
 * Updated:17-Mar-14
 *----------------------------------------------------------------------+
*/

class Data{

	var $mysqli;
	
	/**
	 * [Data constructor]
	 * @param [objet] $mysqli [obtein object conection]
	 */
	function Data($mysqli)
	{
		 $this->mysqli = $mysqli;	
	}
	

	/**
	 * [add method function new register in a table of the db]
	 * @param  [type] $sql [add new register whit insert into sentence]
	 * @return [INT|false]    [int number that is the new register or false when no results]
	 */
	public function add($sql){
		$this->mysqli->query($sql)or trigger_error(mysqli_error() . " in the query:" . $sql ,E_USER_ERROR);			
		
		$sql2 = "SELECT LAST_INSERT_ID( ) AS LAST ";
		$result = $this->mysqli->query($sql2) or trigger_error(mysqli_error($this->mysqli) . " in the query:" . $sql ,E_USER_ERROR);	
		
		$a_resultados = mysqli_fetch_assoc($result);
		 if(mysqli_num_rows($result) == 0){
		 	return FALSE;
		 }else{		 
			$id = $a_resultados["LAST"];
			return 	$id;	
		 }
		 $this->mysqli->query->close();	
	}// Fin de método 


	/**
	 * [get Obtain SQL sentence for process number of row with mysqli_num_rows()]
	 * @param  [string] $sql 	[Sentence for the control with mysqli_num_rows]
	 * @return [array|false]    [FALSE when mysqli_num_rows = 0 or return mysqli_fetch_assoc]
	 */
	public function get($sql){
		$result = $this->mysqli->query($sql) or trigger_error(mysqli_error($this->mysqli) . " in the query:" . $sql ,E_USER_ERROR);
		$a_resultados = mysqli_fetch_assoc ($result);
		 
		 if(mysqli_num_rows($result) == 0){
		 	return FALSE;
		 }else{		 		 	
			return $a_resultados;
		 }

		 $this->mysqli->query->close();	
	}


	/**
	 * [upDate update fields with the SQL sentence]
	 * @param  [string] $sql [SQL sentence for update field by id]
	 * @return [NULL]      [description]
	 */
	public function upDate($sql){
		$this->mysqli->query($sql) or trigger_error(mysqli_error($this->mysqli) . " in the query:" . $sql ,E_USER_ERROR);
		//$this->mysqli->query->close();	
	}

	
	/**
	 * [getList for a sentence SQL obtein the array as result or NULL]
	 * @param  [string] $sql [select SQL sentence]
	 * @return [array|NULL]  [return array with results or NULL for zero data]
	 */
	public function getList($sql){
		$result = $this->mysqli->query($sql) or trigger_error(mysqli_error($this->mysqli) . " in the query:" . $sql ,E_USER_ERROR);	 		 
 		
 		if(mysqli_num_rows($result) == 0){
			return NULL;
		}else{// Pasa a un arreglo los resultados			
			$a_resultados=array(); 
			while ($row=mysqli_fetch_array($result)) { 
			  $a_resultados[]=$row; 
			} 
			return $a_resultados;	
		}
		$this->mysqli->query->close();	
	} 

	
	/**
	 * [delete function]
	 * @param  [string] $sql [delete SQL sentence]
	 * @return [boolean]     [return true o false]
	 */
	public function delete($sql){
		$resultado = $this->mysqli->query($sql) or trigger_error(mysqli_error($this->mysqli) . " in the query:" . $sql ,E_USER_ERROR);
		if($resultado==TRUE){
			return TRUE;
		}else{
			return FALSE;
		}
		$this->mysqli->query->close();	
	}
	
} /* End class */
