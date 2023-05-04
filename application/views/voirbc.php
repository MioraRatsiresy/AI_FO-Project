<?php $url = site_url('index.php');
$bcV = array();
for ($i = 0; $i < count($bc); $i++) {
    $bcV[$i] = unserialize(sprintf('O:%d:"%s"%s', \strlen('BC'), 'BC', strstr(strstr(serialize($bc[$i]), '"'), ':')));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <title>Voir Bon de commande</title>
    <?php
    $this->load->helper('url_helper');
    ?>
</head>

<body>
    <div class="container">
        <input type="hidden" value="<?php echo $value; ?>" name="index">
        <input type="hidden" value="<?php echo $date; ?>" name="date">
        <div class="card-header p-4">
            <div class="float-right">
                <h3 class="mb-0"><?php echo $bcV[$value]->gettitre() . ' numero °' . $bcV[$value]->getnumero(); ?></h3>
                Date: <?php echo $bcV[$value]->getdatecommande(); ?>
                <br />
                Delai de paiement : <?php echo $bcV[$value]->getbcdetail()[0]->getdelaiPaiement(); ?> jours
                <br />
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
                    <h3 class="text-dark mb-1"><?php echo $bcV[$value]->getFournisseurnom(); ?></h3>
                    <div>Adresse: <?php echo $bcV[$value]->getFournisseurlocation(); ?></div>
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
                            <th class="right">Quantité</th>
                            <th class="center">Prix Unitaire</th>
                            <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($bcV[$value]->getbcdetail()); $i++) { ?>
                            <tr>
                                <td class="left strong"><?php echo $bcV[$value]->getbcdetail()[$i]->getcodeproduit(); ?></td>
                                <td class="left"><?php echo $bcV[$value]->getbcdetail()[$i]->getdesignation(); ?></td>
                                <td class="right"><?php echo $bcV[$value]->getbcdetail()[$i]->getquantite(); ?></td>
                                <td class="center"><?php echo $bcV[$value]->getbcdetail()[$i]->getprixu(); ?></td>
                                <td class="right"><?php echo $bcV[$value]->getbcdetail()[$i]->gettotal(); ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                </div>
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Total HT</strong>
                                </td>
                                <td class="right"><?php echo $bcV[$value]->getht(); ?> ariary</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">TVA(20%)</strong>
                                </td>
                                <td class="right"><?php echo $bcV[$value]->gettva(); ?> ariary</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Total TTC</strong>
                                </td>
                                <td class="right"><?php echo $bcV[$value]->getttc(); ?> ariary</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong class="text-dark">Total TTC en lettre</strong>
                                </td>
                                <td class="right">
                                    <?php
                                    $fmt = new NumberFormatter('fr', NumberFormatter::SPELLOUT);
                                    ?>
                                    <strong class="text-dark"><?php echo ucfirst($fmt->format($bcV[$value]->getmontantlettre())); ?> Ariary</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <nav>
            <ul class="pager">
                <?php if ($page > 1 && $page <= count($bcV)) { ?>
                    <li><a href="<?php echo site_url("Welcome/voirBC?page=" . ($page - 1) . "&&date=" . $date . "&&value=" . ($value - 1)); ?>">Previous</a></li>
                <?php }
                if ($page < count($bcV)) { ?>
                    <li><a href="<?php echo site_url("Welcome/voirBC?page=" . ($page + 1) . "&&date=" . $date . "&&value=" . ($value + 1)); ?>">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
        <a class="btn btn-primary" href="<?php echo site_url('Welcome/BC?value=' . $value . '&&date=' . $date) ?>">Generer en pdf</a>
        <a class="btn btn-primary" href="<?php echo site_url('Welcome/indexBon'); ?>">Retour</a>
    </div>
    </div>
    </div>
    <script src="<?php echo site_url('assets/js/jquery.js') ?>"></script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?>"></script>
</body>

</html>