<?php $url = site_url('index.php');
$bcV = unserialize(sprintf('O:%d:"%s"%s', \strlen('BR'), 'BR', strstr(strstr(serialize($br), '"'), ':')));
?>
    <input type="hidden" name="idbc" value="<?php echo $idbc;?>">
    <div class="card-header p-4">
        <div class="float-right">
            <h3 class="mb-0">Bon de réception numero °<?php echo $bcV->getnumero(); ?></h3>
            Date de réception: <?php echo $bcV->getdateReception();?>
            <br />
            Commande n° <?php echo $bcV->getnumerocommande() . ' du ' . $bcV->getdatecommande(); ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h5 class="mb-3">From:</h5>
                <h3 class="text-dark mb-1">My Company</h3>
                        <div>Andoharanofotsy, Antananarivo</div>
                        <div>Email: wwww.company.com</div>
                        <div>Phone: 032 80 506 49</div>
            </div>
            <div class="col-sm-6 ">
                <h5 class="mb-3">To:</h5>
                <h3 class="text-dark mb-1"><?php echo $bcV->getFournisseurnom(); ?></h3>
                <div>Adresse: <?php echo $bcV->getFournisseurlocation(); ?></div>
                <div>Email: contact@bbbootstrap.com</div>
                <div>Phone: +91 9897 989 989</div>
            </div>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Réf. produit</th>
                        <th>Description</th>
                        <th class="right">Quantités commandées</th>
                        <th class="center">Quantités livrées</th>
                        <th>Quantités restant à livrer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($bcV->getBrDetail()); $i++) { ?>
                        <tr>
                            <td class="left strong"><?php echo $bcV->getBrDetail()[$i]->getcodeproduit(); ?></td>
                            <td class="left"><?php echo $bcV->getBrDetail()[$i]->getdesignation(); ?></td>
                            <td class="right" id="total"><?php echo $bcV->getBrDetail()[$i]->getquantiteCommande(); ?></td>
                            <td class="center"><?php echo $bcV->getBrDetail()[$i]->getquantite(); ?></td>
                            <td class="right"><?php echo $bcV->getBrDetail()[$i]->getquantiterestant(); ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</form>