<?php
	/**
	 * 

	Tout ce qui touche proforma et proformaDetail

	 */
	class ProformaModel extends CI_Model
	{
		// modif ------

		public function updatePrix($idProformaDetail, $prix)
		{
			$sql = "UPDATE proformaDetail set prixu = '%s' where idProformaDetail = '%s'";
	 		$sql = sprintf($sql, $prix, $idProformaDetail);

	 		$query = $this->db->query($sql);
		}

		public function selectV_ProformaNonNote()
		{
			$sql = "SELECT * from V_ProformaNonNote";

	 		$query = $this->db->query($sql);

	 		$row = $query->result_array();
	 		return $row;
		}

		public function selectVProforma()
		{
			$sql = "SELECT * from v_proforma";

	 		$query = $this->db->query($sql);

	 		$row = $query->result_array();
	 		return $row;
		}

		// ---------------
		public function selectProduitInGroup(){
			$sql = "SELECT * FROM Produit WHERE idProduit IN(SELECT produitidproduit FROM GroupeDemande)";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		public function moinsDisant()
		{
			$sql = "SELECT * from v_MoinsDisant order by prix asc";

	 		$query = $this->db->query($sql);

	 		$row = $query->result_array();
	 		return $row;
		}
		public function moinsDisantPerProduct($idProduit){
			$sql = "SELECT * from v_MoinsDisant  WHERE idProduit=".$idProduit."order by prix asc";

	 		$query = $this->db->query($sql);

	 		$row = $query->result_array();
	 		return $row;
		}
		public function insertNoteProforma($idProforma, $qualiteNote, $quantiteNote, $prixNote)
		{
			$sql = "INSERT into note(idProforma, qualiteNote, quantiteNote, prixNote) values ('%s','%s', '%s', '%s')";
	 		$sql = sprintf($sql, $idProforma, $qualiteNote, $quantiteNote, $prixNote);

	 		$query = $this->db->query($sql);
		}

		public function insertProformaDetail($quantite, $delai, $lieu, $prix, $idproforma, $idProduit, $idQualite, $demande)
		{
			$sql = "INSERT into proformaDetail(quantite, delaiLivraison, lieuLivraison, prixU, proformaIdProforma, produitIdProduit, idQualite, idgroupedemande) values ('%s','%s', '%s', '%s', '%s', '%s', '%s', '%s')";
	 		$sql = sprintf($sql, $quantite, $delai, $lieu, $prix, $idproforma, $idProduit, $idQualite, $demande);

	 		$query=$this->db->query($sql);
		}
		public function getIdGroupement($idProduit){
			$sql = "SELECT id FROM GroupeDemande WHERE produitidproduit=".$idProduit;
			$query = $this->db->query($sql);

	 		$row = $query->result_array();

	 		if (count($row)!=0) {
	 			return $row[0]["id"];
	 		}
	 		return 0;
		}
		public function getId($numero, $date, $fournisseur)
		{
			$sql = "SELECT idproforma from proforma where numero = '%s' and dateemission='%s' and fournisseurIdFournisseur='%s'; ";
			$sql = sprintf($sql, $numero, $date, $fournisseur);

	 		$query = $this->db->query($sql);

	 		$row = $query->result_array();

	 		if (count($row)!=0) {
	 			return $row[0]["idproforma"];
	 		}
	 		return 0;
		}

	 	public function insertProforma($numero, $date, $fournisseur)
	 	{
	 		$sql = "INSERT into proforma(numero, dateemission, fournisseurIdFournisseur) values ('%s','%s', '%s')";
	 		$sql = sprintf($sql, $numero, $date, $fournisseur);

	 		$query = $this->db->query($sql);
	 	}

		public function selectProforma()
	 	{
	 		$sql = "SELECT * from proforma";

	 		$query = $this->db->query($sql);

	 		$row = $query->result_array();
	 		return $row;
	 	}

	 	public function getNumero()
	 	{
	 		$sql = "SELECT max(idproforma) as numero from proforma";

	 		$query=$this->db->query($sql);

	 		$row=$query->result_array();

	 		if ($row[0]["numero"] != null) {
	 			return $row[0]["numero"]+1;
	 		}

	 		return 1;
	 	}
		
	}
?>