<?php

	/**
	 * 

	 Tout ce qui touche avec le fournisseur


	 */
	 class FournisseurModel extends CI_Model
	 {

	 	public function select($tabName)
		{
			$sql = "SELECT * from ".$tabName;

	 		$query=$this->db->query($sql);

	 		$row=$query->result_array();
	 		return $row;
		}

	 	public function insertFournisseur($nom, $localisation)
	 	{
	 		$sql = "INSERT into fournisseur(nomfournisseur, localisation) values ('%s','%s')";
	 		$sql = sprintf($sql, $nom, $localisation);

	 		$query=$this->db->query($sql);

	 	}

	 	public function updateFournisseur($id, $nom, $localisation)
	 	{
	 		$sql = "UPDATE fournisseur set ";

	 		$sql .= "nomfournisseur = '".$nom."'";
	 		$sql .= ", localisation = '".$localisation."'";

	 		$sql .=" WHERE idfournisseur = ".$id;

	 		$sql = sprintf($sql, $nom,$localisation,$id);

	 		$query=$this->db->query($sql);

	 	}

	 	public function deleteFournisseur($id)
	 	{
	 		$sql = "DELETE from fournisseur where idfournisseur = ".$id;

	 		$query = $this->db->query($sql);
	 	}

	 }

?>