<?php 

    class GroupeDemande extends CI_Model
    {
        private $id;
        private $quantite;
        private $DateGroupage;
        private $ProduitidProduit;
        private $idDemande;
    
        public function setid($variable){
            $this->id = $variable;
        }
        public function getid(){
            return $this->id;
        }
        public function setquantite($idlogin){
            $this->quantite = $idlogin;
        }
        public function getquantite(){
            return $this->quantite;
        }
        public function setDateGroupage($idlogin){
            $this->DateGroupage = $idlogin;
        }
        public function getDateGroupage(){
            return $this->DateGroupage;
        }
        public function setProduitidProduit($idlogin){
            $this->ProduitidProduit = $idlogin;
        }
        public function getProduitidProduit(){
            return $this->ProduitidProduit;
        }
        public function setidDemande($idlogin){
            $this->idDemande = $idlogin;
        }
        public function getidDemande(){
            return $this->idDemande;
        }
        public function selectRegroupementDemande(){
            $requete=" SELECT dategroupage,(select count(distinct fournisseur) from getCommande(GroupeDemande.dategroupage) where getCommande.etat=0) as nombrebcnonenregistre,(SELECT  count(distinct(idbc)) from BC join BCdetail on Bcdetail.bcidbc=idbc where idgroupedemande in (select id from groupedemande where dategroupage=GroupeDemande.dategroupage)) as nbbc from GroupeDemande  group by dategroupage";
            $query=$this->db->query($requete);
            return $query=$query->result_array();
        }
    }
