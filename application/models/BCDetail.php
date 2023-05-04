<?php 

    class BCDetail extends CI_Model
    {
        private $idBCDetail;
        private $BCidBc;
        private $ProformaDetailidProformaDetail;
        private $delaiPaiement;
        private $dateCommande;
        private $codeproduit;
        private $designation;
        private $quantite;
        private $prixu;
        private $total;
        private $regroupement;
    
        public function setregroupement($variable){
            $this->regroupement = $variable;
        }
        public function getregroupement(){
            return $this->regroupement;
        }
        public function setprixu($variable){
            $this->prixu = $variable;
        }
        public function getprixu(){
            return $this->prixu;
        }
        public function settotal($variable){
            $this->total = $variable;
        }
        public function gettotal(){
            return $this->total;
        }
        public function setcodeproduit($variable){
            $this->codeproduit = $variable;
        }
        public function getcodeproduit(){
            return $this->codeproduit;
        }
        public function setdesignation($variable){
            $this->designation = $variable;
        }
        public function getdesignation(){
            return $this->designation;
        }
        public function setquantite($variable){
            $this->quantite = $variable;
        }
        public function getquantite(){
            return $this->quantite;
        }
        public function setidBCDetail($variable){
            $this->idBCDetail = $variable;
        }
        public function getidBCDetail(){
            return $this->idBCDetail;
        }
        public function setBCidBc($idlogin){
            $this->BCidBc = $idlogin;
        }
        public function getBCidBc(){
            return $this->BCidBc;
        }
        public function setProformaDetailidProformaDetail($idlogin){
            $this->ProformaDetailidProformaDetail = $idlogin;
        }
        public function getProformaDetailidProformaDetail(){
            return $this->ProformaDetailidProformaDetail;
        }
        public function setdelaiPaiement($idlogin){
            $this->delaiPaiement = $idlogin;
        }
        public function getdelaiPaiement(){
            return $this->delaiPaiement;
        }
        public function setdateCommande($idlogin){
            $this->dateCommande = $idlogin;
        }
        public function getdateCommande(){
            return $this->dateCommande;
        }
        public function addBCDetail(){
            $sql = "INSERT INTO BCDetail(BCidBc,ProformaDetailidProformaDetail,delaiPaiement,quantite,idgroupedemande) values ('".$this->selectlastBC()."','".$this->getProformaDetailidProformaDetail()."','".$this->getdelaiPaiement()."',".$this->getquantite().",".$this->getregroupement().")";
            $this->db->query($sql);

        }
        public function updateProformaDetail($id){
            $sql = "UPDATE Proformadetail set etat=1 where idproformadetail=".$id;
            $this->db->query($sql);

        }
        public function selectlastBC(){
            $requete="SELECT idBc from BC order by idBC DESC Limit 1";
            $query=$this->db->query($requete);
            $query=$query->result_array();
            $mvt=0;
            foreach($query as $query){
                $mvt=$query['idbc'];
            }
            return $mvt;
        }
        public function getBcDetailPresent($date,$id){
            $requete = "SELECT  * from DetailCommande where idgroupedemande in (select id from groupedemande where idbc=".$id." and dategroupage='".$date."')";
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
    }
