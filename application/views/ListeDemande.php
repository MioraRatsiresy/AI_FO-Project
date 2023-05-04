<?php
    $this->load->helper('url_helper');
    $url = base_url('index.php');
?>
    <div class="container">
        <div class="row">
            <h2 style="text-align: center;">LISTES DES DEMANDES</h2>
            <table class="table">
            <tr>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemande?filtre=1'); ?>"><span class="btn btn-primary" style="background-color: #fcdd78; width: 100%; border-color: #fcdd78; color: black;">Enregistrer</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemande?filtre=2'); ?>"><span class="btn btn-primary" style="background-color: #77d792; width: 100%; border-color: #77d792; color: black;">Valider</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemande?filtre=3'); ?>"><span class="btn btn-primary" style="background-color: #ef757a; width: 100%; border-color: #ef757a; color: black;">Refuser</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemande?filtre=4'); ?>"><span class="btn btn-primary" style="background-color: #8ed1ef; width: 100%; border-color: #8ed1ef; color: black;">Inachever</span></a></th>
               <th style="width: 20%;"><a href="<?php echo base_url('Welcome/listeDemande?filtre=5'); ?>"><span class="btn btn-primary" style="background-color: #cecdcd; width: 100%; border-color: #cecdcd; color: black;">Archiver</span></a></th>
            </tr> 
          </tabla>
            <table class="table">
                <tr>
                   <th><a href="<?php echo base_url('Welcome/listeDemande'); ?>?id=genre"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Rubrique</th>
                   <th><a href="<?php echo base_url('Welcome/listeDemande'); ?>?id=designation"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Designation</th>
                   <th><a href="<?php echo base_url('Welcome/listeDemande'); ?>?id=quantite"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Quantité</th>
                   <th><a href="<?php echo base_url('Welcome/listeDemande'); ?>?id=recu"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Reçu</th>
                   <th><a href="<?php echo base_url('Welcome/listeDemande'); ?>?id=libelledept"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Departement</th>
                   <th><a href="<?php echo base_url('Welcome/listeDemande'); ?>?id=datedemande"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Date</th>
                </tr> 
               <?php foreach ($listeDemande as $key) { 
                if($key['etat']==1) { ?>
                <tr style="background-color: #fcdd78; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==2) {?>
                <tr style="background-color: #77d792; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==3) {?>
                <tr style="background-color: #ef757a; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==4) {?>
                <tr style="background-color: #8ed1ef; height: 70px; font-size: 16px;">
                <?php } if($key['etat']==5) {?>
                <tr style="background-color: #cecdcd; height: 70px; font-size: 16px;">
                <?php } ?>
                   <td><?php echo $key['genre']; ?></td>
                   <td><?php echo $key['designation']; ?></td>
                   <td><?php echo $key['quantite']; ?></td>
                   <td><?php echo $key['recu']; ?></td>
                   <td><?php echo $key['libelledept']; ?></td>
                   <td><?php echo $key['datedemande']; ?></td>
                   <td style="text-align: center;"><input type="checkbox" onchange="choice(<?php echo $key['iddemande']; ?>)" <?php if($key['etat']!=1) { ?> disabled <?php } ?> ></td>
                </tr> 
               <?php } ?>
               <tr>
                   <td><a class="btn btn-primary" href="<?php echo base_url('Welcome/listeDemandeGrouper'); ?>">GROUPER</a></td>
                   <td colspan="4"></td>
                   <td>
                       <form method="POST" action="<?php echo base_url('Welcome/listeDemande'); ?>">
                           <input type="hidden" id="choix" name="choix">
                           <input style="background-color: #29b951; border-color: #29b951;" type="submit" name="valider" value="Autoriser" class="btn btn-primary">
                           <input style="background-color: #db2d34; border-color: #db2d34;" type="submit" name="annuler" value="Refuser" class="btn btn-primary">
                       </form>
                   </td>
                </tr> 
            </table>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript">
        function choice(argument) {
            var __choice = document.getElementById("choix");
            if(__choice.value.includes("'"+argument+"',")){
                __choice.value = __choice.value.replace("'"+argument+"',","");
            }else{
                __choice.value += "'" + argument + "',";
            }
        }
    </script>
