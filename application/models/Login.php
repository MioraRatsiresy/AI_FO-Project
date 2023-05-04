<?php

class Login extends CI_Model {
    public function seLoguer($log,$mdp) {
        $requete = "SELECT idAppro FROM Appro WHERE login = '%s' AND mdp = '%s' ";
        $requete = sprintf($requete,$log,$mdp);
        $requete = $this->db->query($requete);
        $requete = $requete->result_array();
        $verif = 0;
        foreach ($requete as $key) {
            $verif = $key['idappro'];
        }
        if($verif==0){
            return null;
        }
        return $verif;
    }
}

?>