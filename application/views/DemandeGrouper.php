<?php
    $this->load->helper('url_helper');
    $url = base_url('index.php');
?>
    <div class="container">
        <div class="row">
             <?php if(empty($_GET["bon"])){ ?>
            <h2 style="text-align: center;">LISTES DES DEMANDES GROUPEES</h2>
            <table class="table">
                <tr>
                   <th><a href="?id=genre"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Rubrique</th>
                   <th><a href="?id=designation"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Designation</th>
                   <th><a href="?id=quantite"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Quantité</th>
                   <th><a href="?id=dategroupage"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Date</th>
                </tr> 
              <?php foreach ($listeDemandeGrouper as $key) { ?>
                  <tr>
                     <td><?php echo $key['genre']; ?></td>
                     <td><?php echo $key['designation']; ?></td>
                     <td><?php echo $key['quantite']; ?></td>
                     <td><?php echo $key['dategroupage']; ?></td>
                  </tr> 
               <?php } ?>
                  <tr>
                     <td>
                      <a class="btn btn-primary" href="<?php echo base_url('Welcome/listeDemande'); ?>">DEMANDE</a>
                      <a class="btn btn-primary" href="?bon=ok">BON DE RECEPTION</a>
                      </td>
                     <td colspan="4"></td>
                  </tr> 
            </table>
          <?php }else{ ?>
            <table class="table">
                <tr>
                   <th><a href="?id=genre"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Rubrique</th>
                   <th><a href="?id=designation"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Designation</th>
                   <th><a href="?id=quantite"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Quantité demandée</th>
                   <th><a href="?id=dategroupage"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></a> Date</th>
                </tr> 
              <?php foreach ($br as $key) { ?>
                  <?php if($key['etat']==0) {?>
                  <tr style="background-color: #8ed1ef; height: 70px; font-size: 16px;">
                  <?php } if($key['etat']==1) {?>
                  <tr style="background-color: #ea9295; height: 70px; font-size: 16px;">
                  <?php } ?>
                     <td><?php echo $key['genre']; ?></td>
                     <td><?php echo $key['designation']; ?></td>
                     <td><?php echo $key['recu']; ?></td>
                     <td><?php echo $key['dategroupage']; ?></td>
                  </tr> 
               <?php } ?>
                  <tr>
                     <td>
                      <a class="btn btn-primary" href="<?php echo base_url('Welcome/listeDemande'); ?>">DEMANDE</a>
                      <a class="btn btn-primary" href="?">LISTE DES GROUPAGES</a>
                      <a class="btn btn-primary" href="?disp=ok">DEPARTAGER</a>
                      </td>
                     <td colspan="4"></td>
                  </tr> 
            </table>
          <?php } ?>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
