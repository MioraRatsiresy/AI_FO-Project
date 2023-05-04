<?php 
    require_once 'BRDetail.php';
    class BR extends CI_Model
    {
        private $idBr;
        private $numero;
        private $dateReception;
        private $idbc;
        private $FournisseuridFournisseur;
        private $Fournisseurnom;
        private $Fournisseurlocation;
        private $BrDetail;
        private $numerocommande;
        private $datecommande;
    
        public function setnumerocommande($idlogin){
            $this->numerocommande = $idlogin;
        }
        public function getnumerocommande(){
            return $this->numerocommande;
        }
        public function setdatecommande($idlogin){
            $this->datecommande = $idlogin;
        }
        public function getdatecommande(){
            return $this->datecommande;
        }
        public function setBrDetail($idlogin){
            $this->BrDetail = $idlogin;
        }
        public function getBrDetail(){
            return $this->BrDetail;
        }
        public function setFournisseuridFournisseur($idlogin){
            $this->FournisseuridFournisseur = $idlogin;
        }
        public function getFournisseuridFournisseur(){
            return $this->FournisseuridFournisseur;
        }
        public function setFournisseurnom($idlogin){
            $this->Fournisseurnom = $idlogin;
        }
        public function getFournisseurnom(){
            return $this->Fournisseurnom;
        }
        public function setFournisseurlocation($idlogin){
            $this->Fournisseurlocation = $idlogin;
        }
        public function getFournisseurlocation(){
            return $this->Fournisseurlocation;
        }
        public function setidBr($variable){
            $this->idBr = $variable;
        }
        public function getidBr(){
            return $this->idBr;
        }
        public function setdateReception($idlogin){
            $this->dateReception = $idlogin;
        }
        public function getdateReception(){
            return $this->dateReception;
        }
        public function setnumero($idlogin){
            $this->numero = $idlogin;
        }
        public function getnumero(){
            return $this->numero;
        }
        public function setidbc($idlogin){
            $this->idbc = $idlogin;
        }
        public function getidbc(){
            return $this->idbc;
        }
        public function addBR(){
            $sql = "INSERT INTO BR(numero,datereception,idbc) values ('".$this->getnumero()."','".$this->getdateReception()."','".$this->getidbc()."')";
            $this->db->query($sql);

        }
        public function saveBondeReception(){
            $this->addBR();
            for($i=0;$i<count($this->getBrDetail());$i++){
                $this->getBrDetail()[$i]->addBRDetail();
            }
        }
        public function selectlastmvt(){
            $requete="SELECT numero from BR order by idbc DESC Limit 1";
            $query=$this->db->query($requete);
            $query=$query->result_array();

            $requete1="SELECT * from BR";
            $query1=$this->db->query($requete1);
            $query1=$query1->result_array();
            $count=0;
            foreach($query1 as $query1){
                $count=$count+1;
            }
            $mvt=0;
            foreach($query as $query){
                $mvt=$query['numero']+1;
            }
            if($count==0){
                $mvt=$mvt+1;
            }
            return $mvt;
        }
        /*
        public function saveBondeReception(){
            $this->addBR();
            for($i=0;$i<count($this->getbcdetail());$i++){
                $this->getbcdetail()[$i]->addBCDetail();
                $this->getbcdetail()[$i]->updateProformaDetail($this->getbcdetail()[$i]->getProformaDetailidProformaDetail());
            }
        }*/
        public function getBCDetail($idbc){
            $requete = "SELECT * from DetailCommande where idbc=".$idbc;
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
        public function getBCInfo($idbc){
            $requete = "select Fournisseur.*,BC.* from BC join Fournisseur on Fournisseur.idFournisseur=BC.fournisseuridfournisseur where idbc=".$idbc;
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
        public function genererSaisieBR($idbc){
            $br=array();
            $i=0;
            foreach ($this->getBCInfo($idbc) as $bdc) {
                //set br
                $br[$i]=new BR();
                $br[$i]->setnumero($this->selectlastmvt());
                $br[$i]->setidbc($idbc);
                $br[$i]->setFournisseuridFournisseur($bdc['fournisseuridfournisseur']);
                $br[$i]->setFournisseurnom($bdc['nomfournisseur']);
                $br[$i]->setFournisseurlocation($bdc['localisation']);
                $br[$i]->setnumerocommande($bdc['numero']);
                $br[$i]->setdatecommande($bdc['datecommande']);

                $brdetail=array();
                $j=0;
                foreach ($this->getBCDetail($idbc) as $bcd) {
                    $brdetail[$j]=new BRDetail();
                    $brdetail[$j]->setcodeproduit($bcd['codeproduit']);
                    $brdetail[$j]->setdesignation($bcd['designation']);
                    $brdetail[$j]->setquantiteCommande($bcd['quantite']);
                    $brdetail[$j]->setbcdetail($bcd['idbcdetail']);
                    $j=$j+1;
                }
                $br[$i]->setBrDetail($brdetail);
                $i=$i+1;
            }
            return $br;
        }

        public function voirBondereception($idbc){
            $br=array();
            $i=0;
            foreach ($this->getBRpresent($idbc) as $bdc) {
                //set br
                $br[$i]=new BR();
                $br[$i]->setnumero($bdc['numerocommande']);
                $br[$i]->setidbc($idbc);
                $br[$i]->setFournisseuridFournisseur($bdc['idfournisseur']);
                $br[$i]->setFournisseurnom($bdc['nomfournisseur']);
                $br[$i]->setFournisseurlocation($bdc['localisation']);
                $br[$i]->setnumerocommande($bdc['numerocommande']);
                $br[$i]->setdatecommande($bdc['datecommande']);
                $br[$i]->setdatereception($bdc['datereception']);

                $brdetail=array();
                $j=0;
                foreach ($this->getBRDetailpresent($bdc['idbr']) as $bcd) {
                    $brdetail[$j]=new BRDetail();
                    $brdetail[$j]->setcodeproduit($bcd['codeproduit']);
                    $brdetail[$j]->setdesignation($bcd['designation']);
                    $brdetail[$j]->setquantiteCommande($bcd['quantitecommande']);
                    $brdetail[$j]->setquantite($bcd['quantite']);
                    $brdetail[$j]->setquantiterestant($bcd['quantitecommande']-$bcd['quantite']);
                    $brdetail[$j]->setbcdetail($bcd['idbcdetail']);
                    $j=$j+1;
                }
                $br[$i]->setBrDetail($brdetail);
                $i=$i+1;
            }
            return $br;
        }

        public function updateEtatBC($id){
            $sql = "Update BC set etat=1 where idbc=".$id;
            $this->db->query($sql);

        }
        public function getBRpresent($idbc){
            $requete = "SELECT BR.*,BC.numero as numerocommande,BC.datecommande,Fournisseur.* from BR join BC on BC.idbc=BR.idbc join Fournisseur on Fournisseur.idFournisseur=BC.FournisseuridFournisseur where BR.idbc=".$idbc;
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
        public function getBRDetailpresent($idbc){
            $requete = "SELECT BRDetail.*,BCdetail.idbcdetail,BCdetail.quantite as quantitecommande,Produit.* from BRDetail join BCdetail on BCdetail.idbcdetail=BRDetail.bcdetail join ProformaDetail on ProformaDetail.idProformaDetail=BCdetail.ProformaDetailidProformaDetail join Produit on Produit.idProduit=ProformaDetail.ProduitidProduit join rubrique on rubrique.idRubrique=Produit.rubriqueidRubrique join qualite on qualite.idqualite=ProformaDetail.idqualite where bridbr=".$idbc;
            $query = $this->db->query( $requete );
            return $query->result_array();
        }
        
    }
