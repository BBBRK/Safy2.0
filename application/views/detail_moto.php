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
            <?php foreach ($moto as $row){ ?>
                <input hidden type="text" id="idMoto" name="idMoto" value="<?php echo $row->id_Moto; ?>">

                <h1 class="vosmotos"><?php echo $row->nom_Marque. " " .$row->nom_Modele; ?></h1>
                <hr class="horizontal-line hr-detail">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col col-lg-3 col-md-12 col-sm-12 col-xs-12 col-detail">
                            <h4 class="detail-titre">Moteur :</h4>
                            <p class="detail">
                                Bicylindre en L à 90°, 4 temps
                                Refroidissement : Refroidissement par air
                                Injection Ø 45 mm
                                1 ACT, desmodromique
                                2 soupapes par cylindre
                                803 cc (88 x 66 mm)
                                87 ch à 8250 tr/min
                                8 mkg à 6250 tr/min
                                Rapport poids / puissance : 1.92 kg/ch
                            </p>

                            <h4 class="detail-titre">Transmission :</h4>
                            <p class="detail">
                                Boite à 6 rapports
                                Transmission secondaire par chaine
                            </p>
                        </div>

                        <div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="upload-btn-wrapper container">
                                <?php echo form_open_multipart(); ?>

                                    <?php foreach ($moto as $raw) {
                                        $picture = file_exists("./assets/images/photo_user/$raw->id_Moto.jpg");

                                        if($picture == true){ ?>

                                        <img src='<?php echo base_url("assets/images/photo_user/$raw->id_Moto");?>' class="photo-detail" id="detailImg" alt="mes motos">

                                    <?php }else{

                                            $substrName = substr($raw->nom_Modele, 0, 3);

                                        ?>
                                            <img src='<?php echo base_url("assets/images/photo_constructeur/$substrName");?>' class="photo-detail" id="detailImg" alt="mes motos">


                                        <?php } ?>





                                    <input type="file" classe="btn-photo" id="uploadPhoto" name="myfile"/>
                                    <!-- Permet de reccuperer l'id dans le formulaire -->
                                    <input type="hidden" class="form-control sub" name="id_moto" value="<?php echo $raw->id_Moto; ?>">
                                    <?php  } ?>
                                    <button type="submit" id="submit-photo" class="btn btn-primary submit" hidden>Submit</button>
                                </form>
                            </div>
                            <small class="changerPhoto">Cliquez sur la photo pour la changer !</small>
                        </div>

                        <div class="col col-lg-3 col-md-12  col-sm-12 col-xs-12">
                            <h4 class="detail-titre">Chassis :</h4>
                            <p class="detail">
                                Cadre : Treillis tubulaire en acier
                                Réservoir : 15 litres
                                Hauteur de selle : 800 mm
                                Empattement : 1450 mm
                                Poids à sec : 167 kg
                            </p>
                        </div>
                    </div>
                </div>
        </section>

        <section>
            <h1 class="vosmotos">Votre moto</h1>
            <hr class="horizontal-line hr-votre-moto">
            <nav class="navbar navbar-expand-lg navbar-dark " id="navbar">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

                    <ul class="navbar-nav mx-auto">
                        <li class="nav_item">
                            <a class="nav-link nav_detail" id="suivi" href="#sante-moto" onclick="sante();">Santé moto</a>
                        </li>
                        <li class="nav_item">
                            <a class="nav-link nav_detail" onclick="showModalKm();">Mise à jour km</a>
                        </li>
                        <li class="nav_item">
                            <a class="nav-link nav_detail" onclick="showModalNewEntretien();">Ajouter entretien</a>
                        </li>
                        <li class="nav_item">
                            <a class="nav-link nav_detail" id="historique" href="#historique" onclick="historique();">Historique</a>
                        </li>

                        <li class="nav_item">
                            <a class="nav-link nav_detail" href="<?php echo site_url('moto/delete_moto/'.$row->id_Moto); ?>" onclick="return confirm('Etes-vous sûr ?')">Supprimer moto</a>
                        </li>
                    </ul>

                    <!-- <ul class="navbar-nav  ml-auto">
                        <li class="nav_item">
                            <a class="nav-link nav_detail" href="<?php //echo site_url('moto/delete_moto/'.$row->id_Moto); ?>" onclick="return confirm('Etes-vous sûr ?')">Supprimer moto</a>
                        </li>
                    </ul> -->
                </div>
            </nav>


            <div class="moto-sante" id="sante-moto">

                <h3 class="kilometre">Kilomètrage : <?php echo $row->km_Moto; ?> km</h3>
                <?php } ?> <!--  line 51 -->


                <div class="container-fluid">
                    <div class="row">
                        <div class="col col-lg-12 col-detail">
                            <div class="row">
                                <div class="col col-lg-4">
                                    <div>
                                        <p class="detail">Usure théorique pneu avant:</p>
                                    </div>
                                    <div>
                                        <p class="detail">Usure théorique pneu arrière:</p>
                                    </div>
                                    <div>
                                        <p class="detail">Usure théorique kit chaine:</p>
                                    </div>
                                    <div>
                                        <p class="detail">Vidange:</p>
                                    </div>
                                    <div>
                                        <p class="detail">Usure théorique plaquettes avant:</p>
                                    </div>
                                    <div>
                                        <p class="detail">Usure théorique plaquettes arrière:</p>
                                    </div>
                                    <div>
                                        <p class="detail">Purge liquide de frein:</p>
                                    </div>
                                </div>

                                <div class="col col-lg-8">
                                    <?php
                                    // VOIR POUR ENTRER CA DANS LE CONTROLLER
                                    $data = array($pneuAv, $pneuArr, $kitChaine, $vid, $plaqAv, $plaqArr, $purge);

                                        $var = [];
                                    for ($i=0; $i < count($data); $i++) {

                                        if ($data[$i] >= 100) {
                                            array_push($var, 1);
                                        }
                                        else {
                                            array_push($var, "0.".$data[$i]);
                                        }

                                        $var[$i] = (float)$var[$i];

                                    }

                                    ?>
                                    <div class="row">
                                        <div class="col col-lg-9 col-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar test-0" id="0" role="progressbar" style="opacity: <?php echo $var[0]; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $pneuAv; ?> %</div>
                                            </div>
                                        </div>

                                        <?php if ($pneuAv >= 80) { ?>
                                            <div class="col col-lg-3 progress-icone">
                                                <button type="button" class="btn btn-secondary myPop blink" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="L'usure théorique de votre pneu avant est élevé, nous vous conseillons d'effectuer un contrôle visuel. Le prix moyen d'un changement de pneu avant est de 120€."><i class="fas fa-exclamation"></i></button>
                                            </div>
                                        <?php } ?>

                                    </div>





                                    <div class="row">
                                        <div class="col col-lg-9 col-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar test-1" id="1" role="progressbar" style="opacity: <?php echo $var[1]; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $pneuArr; ?> %</div>
                                            </div>
                                        </div>

                                        <?php if ($pneuArr >= 80) { ?>
                                            <div class="col col-lg-3 progress-icone">
                                                <button type="button" class="btn btn-secondary myPop blink" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="L'usure théorique de votre pneu arrière est élevé, nous vous conseillons d'effectuer un contrôle visuel. Le prix moyen d'un changement de pneu avant est de 150€."><i class="fas fa-exclamation"></i></button>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="row">
                                        <div class="col col-lg-9 col-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar test-2" id="2" role="progressbar" style="opacity: <?php echo $var[2]; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $kitChaine; ?> %</div>
                                            </div>
                                        </div>

                                        <?php if ($kitChaine >= 80) { ?>
                                            <div class="col col-lg-3 progress-icone">
                                                <button type="button" class="btn btn-secondary myPop blink" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="L'usure théorique de votre kit chaine est élevé, nous vous conseillons d'effectuer un contrôle visuel. Le prix moyen d'un changement de pneu avant est de 200€."><i class="fas fa-exclamation"></i></button>
                                            </div>
                                        <?php } ?>
                                    </div>


                                    <div class="row">
                                        <div class="col col-lg-9 col-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar test-3" id="3" role="progressbar" style="opacity: <?php echo $var[3]; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $vid; ?> %</div>
                                            </div>
                                        </div>

                                        <?php if ($vid >= 80) { ?>
                                            <div class="col col-lg-3 progress-icone">
                                                <button type="button" class="btn btn-secondary myPop blink" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Votre huile moteur arrive à péremption, nous vous conseillons d'effectuer une vidange. Le prix moyen d'une vidange avec changement du filtre à huile est de 70€."><i class="fas fa-exclamation"></i></button>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="row">
                                        <div class="col col-lg-9 col-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar test-4" id="4" role="progressbar" style="opacity: <?php echo $var[4]; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $plaqAv; ?> %</div>
                                            </div>
                                        </div>

                                        <?php if ($plaqAv >= 80) { ?>
                                            <div class="col col-lg-3 progress-icone">
                                                <button type="button" class="btn btn-secondary myPop blink" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="L'usure théorique de vos plaquettes avant est élevé, nous vous conseillons d'effectuer un contrôle visuel. Le prix moyen d'un changement de plaquette avant est de 90€."><i class="fas fa-exclamation"></i></button>
                                            </div>
                                        <?php } ?>
                                    </div>


                                    <div class="row">
                                        <div class="col col-lg-9 col-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar test-5" id="5" role="progressbar" style="opacity: <?php echo $var[5]; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $plaqArr; ?> %</div>
                                            </div>
                                        </div>


                                        <?php if ($plaqArr >= 80) { ?>
                                            <div class="col col-lg-3 progress-icone">
                                                <button type="button" class="btn btn-secondary myPop blink" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="L'usure théorique de vos plaquettes arrière est élevé, nous vous conseillons d'effectuer un contrôle visuel. Le prix moyen d'un changement de plaquette arrière est de 40€."><i class="fas fa-exclamation"></i></button>
                                            </div>
                                        <?php } ?>
                                    </div>


                                    <div class="row">
                                        <div class="col col-lg-9 col-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar test-6" id="6" role="progressbar" style="opacity: <?php echo $var[6]; ?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"><?php echo $purge; ?> %</div>
                                            </div>
                                        </div>

                                        <?php if ($purge >= 80) { ?>
                                            <div class="col col-lg-3 progress-icone">
                                                <button type="button" class="btn btn-secondary myPop blink" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Votre liquide de frein arrive à péremption, Nous vous conseillons d'effectuer une vidange. Le prix moyen d'une purge est de 40€."><i class="fas fa-exclamation"></i></button>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="historique" id="historique">

                <div class="table-responsive">

                    <table id="table" class="table">
                        <thead>
                             <!-- Entetes du tableau administrateur -->
                            <tr class="header-historique">
                                <th class="head-historique"scope="col">Type</th>
                                <th class="head-historique larg-historique"scope="col">Description</th>
                                <th class="head-historique"scope="col">Km</th>
                                <th class="head-historique"scope="col">Date</th>
                                <th class="head-historique"scope="col">Prix</th>
                                <th class="head-historique"scope="col"> </th>
                                <th class="head-historique"scope="col"> </th>
                                <th class="head-historique"scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody id="tr">
                            <!-- AJOUT DU CONTENU EN AJAX VIA ajax-nav.js -->
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


                    <!-- ********************** MODALS BOOTSTRAP ********************************* -->

                    <!-- FACTURE -->

        <?php foreach ($historique as $histo){ ?>

        <div id="modal-facture-<?= $histo->id; ?>" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Gestion des factures</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                  <img src="<?php echo base_url("assets/images/factures/$histo->id") ?>" alt="">
              </div>
            </div>
          </div>
        </div>

<?php } ?>

                    <!-- AJOUT ENTRETIEN -->

    <div id="modal-entretien" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajout d'une opération</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php echo validation_errors(); ?>
              <?php echo form_open('moto/ajout_operation', 'id="form_operation"'); ?>
                  <div class="modal-form">

                        <div class="form-group form-group1">
                            <label class="lab-input">Type</label>
                            <select class="form-control sub" name="id_operation">
                                <?php foreach ($operation as $row) {
                                    echo '<option value='.$row->id.'>'.$row->type.'</option>';
                                } ?>


                            </select>


                            <!-- Champs caché pour reccuperer l'id dans la fonction "ajout_operation" dans le controller -->
                            <?php foreach ($moto as $raw) { ?>
                            <input type="hidden" class="form-control sub" name="id_moto" value="<?php echo $raw->id_Moto; ?>">
                            <?php } ?>

                            <label class="lab-input">Date</label>
                            <input type="date" class="form-control sub" name="date_operation">

                            <label class="lab-input">Km</label>
                            <input type="text" class="form-control sub" name="km">

                            <label class="lab-input">Description</label>
                            <textarea name="description" class="form-control sub-text" rows="5" cols="80"></textarea>

                            <label class="lab-input">Prix total</label>
                            <input type="text" class="form-control sub" name="prix">

                        </div>

                        <button type="submit" class="btn btn-primary submit">Submit</button>

                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>

                        <!-- MODIF ENTRETIEN -->
                        <!-- This modal is completed thanks to the ajax function in the file "open-modal.js" -->

    <?php foreach ($historique as $histo){ ?>

        <div id="modal-update-entretien-<?= $histo->id; ?>" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog " role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Ajout d'une opération</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php echo validation_errors();
                      echo form_open('moto/modif_historique/'.$histo->id, 'id="form_operation"'); ?>
                      <div class="modal-form">

                            <div class="form-group form-group1">
                                <label class="lab-input">Type</label>
                                <select class="form-control sub" name="id_operation">

                                    <?php foreach ($operation as $row) { ?>
                                            <option value="<?php echo $row->id;?>"
                                                <?php if($row->id != ""){
                                                    echo " selected";
                                                }
                                                echo ">".$row->type."</option>\n"; ?>

                                        <?php
                                    }
                                    ?>
                                </select>

                                <label class="lab-input">Date</label>
                                <input type="date" class="form-control sub" name="date_operation" value="<?= $histo->date_operation; ?>">

                                <label class="lab-input">Km</label>
                                <input type="text" class="form-control sub" name="km" value="<?= $histo->km; ?>">

                                <label class="lab-input">Description</label>
                                <textarea name="description" class="form-control sub-text" rows="5" cols="80"><?= $histo->description; ?></textarea>

                                <label class="lab-input">Prix total</label>
                                <input type="text" class="form-control sub" name="prix" value="<?= $histo->prix; ?>">

                                <input type="hidden" name="id_Moto" value="<?php echo $moto[0]->id_Moto ?>">
                            </div>

                            <button type="submit" class="btn btn-primary submit">Submit</button>

                          </div>
                      </form>
                  </div>
                </div>
              </div>
            </div>
        <?php } ?>


                    <!-- MISE A JOUR KM -->

    <div id="modal-km" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Mise à jour kilomètrique</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php echo validation_errors(); ?>
              <?php echo form_open('moto/maj_km', 'id="form_km"'); ?>
              <div id="error_msg">

              </div>
                  <div class="modal-form">

                        <div class="form-group form-group1">
                            <label class="lab-input">Kilomètrage</label>
                            <input type="text" class="form-control sub" id="km" name="km_Moto">

                            <?php foreach ($moto as $raw) { ?>
                            <input type="hidden" class="form-control sub" name="id_moto" value="<?php echo $raw->id_Moto; ?>">
                            <?php } ?>
                        </div>

                        <button type="submit" class="btn btn-primary submit">Submit</button>
                      </form>

                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>



    </script>

        <!-- Bootstrap scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <!-- js scripts -->
        <script src="<?php echo base_url('assets/script/open-modal/open-modal.js');?>"></script>
        <script src="<?php echo base_url('assets/script/upload-photo.js');?>"></script>
        <script src="<?php echo base_url('assets/script/user-photo-autosubmit.js');?>"></script>
        <script src="<?php echo base_url('assets/script/animated-progressbar.js');?>"></script>
        <script src="<?php echo base_url('assets/script/frais-a-venir.js'); ?>"></script>




        <!-- <script src="<?php // echo base_url('assets/script/ajax_km_error.js');?>"></script> -->






    </body>


    <script>

        var divSante = document.querySelector(".moto-sante");
        var divHistorique = document.querySelector(".historique");
        var idMoto = $("#idMoto").val();



        function sante(){

            divHistorique.style.display = "none";
            divSante.style.display = "block";
        }

        function historique(){

            divSante.style.display = "none";

             var id = <?php echo $moto[0]->id_Moto; ?>;


            $.ajax({
                url: "<?= site_url("moto/historique") ?>/" + idMoto,
                dataType: "json",
                success: function(data){

                    var result = "";
                    for(var historique of data){

                        result += '<tr id="click-' + historique.id + '"><td class="height-row">' + historique.type + '</td>';
                        result += "<td class='height-row click'>" + historique.description + "</td>";
                        result += "<td class='height-row'>" + historique.km + " km" + "</td>";
                        result += "<td class='height-row'>" + historique.date_operation + "</td>";
                        result += "<td class='height-row'>" + historique.prix + "€" + "</td>";
                        result += "<td class='height-row'><button data-toggle='modal' data-target=#modal-update-entretien-" + historique.id + "><i class='far fa-edit icon'></i></button></td>";
                        result += "<td class='height-row'><a href='http://localhost/safymotor/index.php/moto/delete_historique/" + historique.id + "'><i class='fas fa-trash-alt icon'></i></a></td>";
                        result += "<td class='height-row'><form enctype='multipart/form-data' action='http://localhost/Safy2.0/index.php/facture/ajout' method='post'><input type='file' name='facture'><input type='hidden' name='id_histo' value='" + historique.id + "'><input type='hidden' name='id_moto' value='" + id + "'><input type='submit' class='butn btn btn-lg' value='Valider'></form></td></tr>"
// <button data-toggle='modal' data-target='#modal-facture-'><i class='fas fa-cloud-upload-alt'></i></td><tr>";


                    }
                    $("#tr").html(result);

                    $(".click").click(function(){

                        // console.log(this.parentNode.id);

                        var idFacture = this.parentNode.id.slice(6);
                        $("#modal-facture-" + idFacture).modal("show");
                    });

                },
                error: function(){
                    alert("ERREUR.");
                }
            });


            divHistorique.style.display = "block";


            // $(document).ajaxComplete(function(){
            //
            //
            // })


        }

    </script>


    <script>

    // TEST DE SCRIPT D'ANIMATION DES PROGRESS BARS
            $(document).ready(function(){

                document.getElementById("suivi").addEventListener("click", function(){

                    var data = [<?= $pneuAv; ?>, <?= $pneuArr; ?>, <?= $kitChaine; ?>, <?= $vid; ?>, <?= $plaqAv; ?>, <?= $plaqArr; ?>, <?= $purge; ?>];


                    for (var i = 0; i < data.length; i++){


                        var elem = document.querySelector(".test-" + i);
                        var width = 0;
                        var id = setInterval(frame, 3);
                        frame();
                        function frame(){

                            for (var j = 0; j < data[i]; j++) {
                                //setTimeout(function(){

                                    console.log(data[i]);

                                    if (width >= data[i]) {
                                            clearInterval(id);
                                    }
                                    else{
                                        width++;
                                        elem.style.width = width + "%";
                                    }
                                //}, 100);

                            }

                        }
                    }

                });




            });
    </script>

</html>
