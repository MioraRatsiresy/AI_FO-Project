<?php

class Demande extends CI_Model {
    public function listeDemande($order,$etat) {
        $__order = "";
        if($order!="0"){
            $__order = " ORDER BY ".$order." ASC";
        }
        $__etat = "";
        if($etat!="0"){
            $__etat = " AND etat = ".$etat;
        }
        $requete = "SELECT * FROM PRDDepartement WHERE etat != 0 %s %s ";
        $requete = sprintf($requete,$__etat,$__order);
        $requete = $this->db->query($requete);
        return $requete->result_array();
    }
    public function listeDemandeDept($order,$etat,$idDept) {
        $__order = "";
        if($order!="0"){
            $__order = " ORDER BY ".$order." ASC";
        }
        $__etat = "";
        if($etat!="0"){
            $__etat = " AND etat = ".$etat;
        }
        $requete = "SELECT * FROM PRDDepartement WHERE etat != 0 %s %s AND iddept=".$idDept;
        $requete = sprintf($requete,$__etat,$__order);
        $requete = $this->db->query($requete);
        return $requete->result_array();
    }
    public function actionDemande($ids,$etat){
        $ids = substr($ids, 0,strlen($ids)-1);
        $requete = "UPDATE Demande SET etat = %s WHERE idDemande IN(%s)";
        $requete = sprintf($requete,$etat,$ids);
        $this->db->query($requete);
    }

    // Goupages
    public function getDemandeGrouper($order){
        $requete = "SELECT ProduitidProduit FROM Demande WHERE etat = 2 GROUP BY ProduitidProduit";
        $requete = $this->db->query($requete);
        $requete = $requete->result_array();
        $i = 0;
        foreach ($requete as $key) {
            $__requete = "SELECT * FROM PRDDepartement WHERE etat = 2";
            $__requete = $this->db->query($__requete);
            $__requete = $__requete->result_array();
            $quantite = 0;
            $produitidproduit = "";
            $idDemande = "";
            $genre = "";
            $designation = "";
            foreach ($__requete as $__key) {
                if($key["produitidproduit"]==$__key["produitidproduit"]){
                    $quantite += $__key["quantite"];
                    $produitidproduit = $__key["produitidproduit"];
                    $genre = $__key["genre"];
                    $designation = $__key["designation"];
                    $idDemande = $__key["iddemande"].",".$idDemande;
                    $update = "UPDATE  Demande SET etat = 4 WHERE idDemande = %s";
                    $update = sprintf($update,$__key["iddemande"]);
                    $this->db->query($update);
                }
            }
            $insert = "INSERT INTO GroupeDemande (quantite,idDemande,produitidproduit) VALUES (%s,'%s',%s)";
            $insert = sprintf($insert,$quantite,'('.substr($idDemande, 0,strlen($idDemande)-1).')',$produitidproduit);
            $this->db->query($insert);

        }
        $__order = "";
        if($order!="0"){
            $__order = " ORDER BY ".$order." ASC";
        }
        $groupement = "SELECT * FROM PRDemandeG  %s";
        $groupement = sprintf($groupement,$__order);
        $groupement = $this->db->query($groupement);
        return $groupement->result_array();
    }
    public function besoin($order){
        $__order = "";
        if($order!="0"){
            $__order = " ORDER BY ".$order." ASC";
        }
        $groupement = "SELECT * FROM PRDemandeG  WHERE id NOT IN(SELECT idgroupedemande FROM proformadetail) %s";
        $groupement = sprintf($groupement,$__order);
        $groupement = $this->db->query($groupement);
        return $groupement->result_array();
    }
    // Dispatch
    public function Dispatch(){
        $requete = "SELECT * FROM v_BRDetail WHERE etat = 0";
        $requete = $this->db->query($requete);
        $requete = $requete->result_array();
        foreach ($requete as $key) {
            $__requete = "SELECT * FROM GroupeDemande WHERE id =" . $key["idgroupedemande"];
            $__requete = $this->db->query($__requete);
            $__requete = $__requete->result_array();
            foreach ($__requete as $__key) {
                $___requete = "SELECT (sum(quantite)-sum(recu)) as reste FROM Demande WHERE idDemande in %s AND etat=4";
                $__idDemande = $__key['iddemande'];
                $___requete = sprintf($___requete,$__idDemande);
                $___requete = $this->db->query($___requete);
                $___requete = $___requete->result_array();
                $recu = $key["quantite"];
                $reste = $___requete[0]["reste"];
                if($reste==0){
                    break;
                }
                $_requete = "SELECT idDemande,(sum(quantite)-sum(recu)) as reste,recu,quantite FROM Demande WHERE idDemande in %s AND etat=4 GROUP BY idDemande";
                $_requete = sprintf($_requete,$__idDemande);
                $_requete = $this->db->query($_requete);
                $_requete = $_requete->result_array();
                foreach ($_requete as $_key) {
                    $prorataObtenu = $this->prorata($recu,$_key["reste"],$reste);
                    $__recu = $prorataObtenu + $_key["recu"];
                    $plus = "";
                    if($__recu>=$_key["quantite"]){
                        $plus = ",etat=5 ";
                    }
                    $update = "UPDATE Demande set recu = %s %s WHERE idDemande = %s";
                    $update = sprintf($update,$__recu,$plus,$_key["iddemande"]);
                    $this->db->query($update);
                }
            }
            $__update = "UPDATE BRDetail SET etat = 1 WHERE idbrdetail = %s";
            $__update = sprintf($__update,$key["idbrdetail"]);
            $this->db->query($__update);
        }
        
    }

    //Prorata
    public function prorata($recu,$demande,$totalDemande){
        return round(($recu*$demande)/$totalDemande);
    }

    //Bon de reception
    public function BRDetail(){
        $br = "SELECT * FROM BRDetailPRDG";
        $br = $this->db->query($br);
        return $br->result_array();
    }

    public function selectProduitInGroup(){
        $sql = "SELECT * FROM Produit WHERE idProduit IN(SELECT produitidproduit FROM GroupeDemande)";
        $query =$this->db->query($sql);
        return $query->result_array();
    }
}

?>