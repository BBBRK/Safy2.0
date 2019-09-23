<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include("assets/php/entete.php");
?>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark nav" id="navbar">
        <a class="navbar-brand" href="<?php echo site_url('safy/index'); ?>">Safy</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

            <?php if($this->session->user): ?>

            <ul class="navbar-nav  mr-auto">
                <li class="nav_item">
                    <a class="nav-link nav_item" id="navnav" href="<?php echo site_url('safy/userindex'); ?>">Mes motos</a>
                </li>
            </ul>

            <ul class="navbar-nav  ml-auto">

                <li class="nav_item">
                    <a class="nav-link nav_item" id="navnav" href="<?php echo site_url('register/logout'); ?>">Deconnexion</a>
                </li>
                <li class="nav_item">
                    <a class="nav-link nav_item" id="navnav" href="<?php echo site_url('register/login'); ?>">Bonjour <?= $this->session->user->prenom_Proprietaire ;?></a>
                </li>
                <?php else: ?>

                    <ul class="navbar-nav  ml-auto">
                        <li class="nav_item">
                            <a class="nav-link nav_item" id="navnav" href="<?php echo site_url('register/subscribe') ?>">Inscription</a>
                        </li>
                        <li class="nav_item">
                            <a class="nav-link nav_item" id="navnav" href="<?php echo site_url('register/login') ?>">Connexion</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

            <section>
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-9">
                            <img class="big-photo" src="<?php echo base_url('assets/images/harley1.jpg');?>" alt="">
                        </div>

                        <div class="col-lg-3">
                            <img class="little-photo little-photo-top" src="<?php echo base_url('assets/images/moto_penche1.jpg');?>" alt="">
                            <img class="little-photo"src="<?php echo base_url('assets/images/harley2.jpg');?>" alt="">
                        </div>

                    </div>
                </div>
            </section>

            <section class="section2">

                <hr class="horizontal-line">
                <br>
                <br>

                <h1 class="master">Maitrisez votre moto</h1>
                <div>
                    <div class="container-fluid">
                        <div class="row customers">

                            <div class="col-lg-3 align ut">
                                <h3 class="what">Qu'est ce que c'est ?</h3>
                            </div>

                            <div class="col-lg-9 align">
                                <p class="parragraphe">Safy est une plateforme où vous creez en quelques cliques votre profil moto afin de stocker toute les informations concernant celle-ci</p>
                            </div>

                        </div>

                        <div class="row customers">

                            <div class="col-lg-3 center ut">
                                <h3 class="what a-quoi-ca-sert">A quoi ça sert ?</h3>
                            </div>

                            <div class="col-lg-9">
                                <div class="row for-what">
                                    <div class="col-lg-9">
                                        <p>Archivez vos factures<br /><small>Ne perdez plus vos factures et stockez les facilement.</small></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="fas fa-archive fa-5x"></span>
                                    </div>
                                </div>

                                <div class="row for-what">
                                    <div class="col-lg-9">
                                        <p>Suivi kilomètrique<br /><small>Suivi kilométrique de votre moto, pneus, kit chaine, vidange, ...</small></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="fas fa-road fa-5x"></span>
                                    </div>
                                </div>

                                <div class="row for-what">
                                    <div class="col-lg-9">
                                        <p>Rappel des entretiens<br /><small>Notification lors de l'approche d'une révision avec coût moyen et detail de celle-ci.</small></p>
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="fas fa-bell fa-5x"></span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row customers">

                            <div class="col-lg-3 align bottom ut">
                                <h3 class="what">Pour qui ?</h3>
                            </div>

                            <div class="col-lg-9 align bottom">
                                <p class="parragraphe">Safy est destiné a tous les motards souhaitant un suivi précis de sa machine sans prise de tête :)</p>
                            </div>

                        </div>
                    </div>

                </div>
                <hr class="horizontal-line">
            </section>

            <section class="section3">

                <span class="fas fa-exclamation-triangle fa-5x"></span>
                <br>
                <br>
                <p>
                    Application mobile en développement !!
                </p>



            </section>



    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- js scripts -->
</body>

</html>
