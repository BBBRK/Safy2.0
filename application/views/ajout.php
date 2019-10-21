<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("assets/php/entete.php");
?>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark nav" id="navbar">
            <a class="navbar-brand" href="<?php echo site_url('safy/index') ?>">Safy</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav  mr-auto">
                    <li class="nav_item">
                        <a class="nav-link" id="navnav" href="<?php echo site_url('safy/userindex') ?>">Mes motos</a>
                    </li>
                </ul>
                <ul class="navbar-nav  ml-auto">
                    <li class="nav-item">
                        <?php if($this->session->user): ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/logout') ?>">Deconnexion</a>
                    </li>
                    <li class="nav-item">
                        <?php else: ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/subscribe') ?>">Inscription</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if($this->session->user): ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/login') ?>">Bonjour <?= $this->session->user->prenom_Proprietaire ;?></a>
                    </li>
                    <li class="nav-item">
                    <?php else: ?>
                        <a class="nav-link" id="navnav" href="<?php echo site_url('register/login') ?>">Connexion</a>
                    <?php endif; ?>
                    </li>
                </ul>
            </div>
        </nav>

        <?php echo form_open_multipart(); ?>
            <div class="connexion-form">
                  <div class="form-group">
                      <label class="lab-input">Marque :</label>
                      <select class="form-control sub" name="marqueId" id="marque">
                          <option value="">Selectionnez la marque</option>

                          <?php foreach ($marque as $row) {
                              echo '<option value='.$row->id_Marque.'>'.$row->nom_Marque.'</option>';
                          } ?>
                      </select>
                  </div>

                  <div class="form-group">
                    <label class="lab-input">Modèle :</label>
                    <select class="form-control sub" name="id_Modele" id="modele" disabled="">
                        <option value="">Selectionnez le modèle</option>
                    </select>
                  </div>

                  <div class="form-group">
                      <label class="lab-input">Date de mise en circulation :</label>
                      <input type="date" class="form-control sub" name="date_circu_Moto">
                  </div>

                  <button type="submit" class="btn btn-primary submit">Submit</button>
            </div>
        </form>

        <!-- Bootstrap scripts + jquery + ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        <!-- js scripts -->
        <script src="<?php echo base_url('assets/script/double_select_marque.js');?>"></script>

    </body>
</html>
