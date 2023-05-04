<?php
	
	/**
	 * 
	 */
	class AchatVente extends CI_Model
	{
		
		public function select($tabName)
		{
			$sql = "SELECT * from ".$tabName;

	 		$query=$this->db->query($sql);

	 		$row=$query->result_array();
	 		return $row;
		}
	}

?>