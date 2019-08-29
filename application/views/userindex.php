<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include("assets/php/entete.php");
?>

    <body class="body-userindex">

        <nav class="navbar navbar-expand-lg navbar-dark nav" id="navbar">
            <a class="navbar-brand" href="<?php echo site_url('safy/index'); ?>">Safy</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

                <ul class="navbar-nav  mr-auto">
                    <li class="nav_item">
                        <a class="nav-link" id="navnav" href="<?php echo site_url('safy/userindex'); ?>">Mes motos</a>
                    </li>
                </ul>

                <ul class="navbar-nav  ml-auto">
                    <li class="nav_item">
                        <?php if($this->session->user): ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/logout'); ?>">Deconnexion</a>
                    </li>

                    <li class="nav_item">
                        <?php else: ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/subscribe'); ?>">Inscription</a>
                        <?php endif; ?>
                    </li>


                    <li class="nav_item">
                        <?php if($this->session->user): ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/login'); ?>">Bonjour <?= $this->session->user->prenom_Proprietaire ;?></a>
                    </li>

                    <li class="nav_item">
                    <?php else: ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/login'); ?>">Connexion</a>
                    <?php endif; ?>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="section-userindex container">
                <h1 class="vosmotos">Mes motos</h1>
                <hr class="horizontal-line">

            <div class="col-cards container">
                    <div class="row">

                        <?php
                            // fonction permettant d'afficher 3 carte/ligne
                            $colNumber = 3;
                            $cardCount = 0;

                            foreach ($moto as $row){
                        ?>
                            <div class="col col-lg-4 col-md-6 col-12 test">
                                <div class="card">


                                    <!-- Function if the user dont customise the picture, a standar picture of the bike is display -->
                                    <?php
                                    $picture = file_exists("C:\wamp\www\safymotor\assets\images\photo_user/$row->id_Moto.jpg");

                                    if($picture == true){ ?>

                                        <img src='<?php echo base_url("assets/images/photo_user/$row->id_Moto");?>' class="cards-photo" alt="mes motos">
                                    <?php }
                                    else{
                                        $substrName = substr($row->nom_Modele, 0, 3);
                                    ?>
                                        <img src='<?php echo base_url("assets/images/photo_constructeur/$substrName");?>' class="cards-photo" alt="mes motos">

                                    <?php } ?>

                                  <div class="card-body">
                                    <h2 class="card-title"><?php echo $row->nom_Modele; ?></h2>
                                    <hr class="horizontal-line hr-userindex">
                                    <a class="href-date" href="<?php echo site_url("moto/detail_moto/".$row->id_Moto); ?>" class="card-text"><small class="small">Dernière mise à jour le <?php echo $row->date_modif; ?></small></a>
                                  </div>
                                </div>
                            </div>


                            <?php
                                // Si 3 card dans la ligne, recreer une ligne
                                $cardCount++;
                                if($cardCount == 3){
                                    echo '</div><div class="row">';
                                }
                            } //ligne 62
                             ?>
                         </div> <!-- ligne 78 -->

                </div> <!-- col-cards ligne 55 -->

        </section>

        <a class="" href='<?php echo site_url("moto/ajout/"); ?>'><span class="far fa-plus-square fa-3x"></span></a>




        <!-- Bootstrap scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <!-- js scripts -->
        <script src="<?php echo base_url('assets/script/click_detail.js');?>"></script>
    </body>

</html>
