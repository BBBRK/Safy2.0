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

                <ul class="navbar-nav  ml-auto">
                    <li class="nav_item">
                        <a class="nav-link nav_item" id="navnav" href="<?php echo site_url('register/subscribe') ?>">Inscription</a>
                    </li>
                    <li class="nav_item">
                        <a class="nav-link nav_item" id="navnav" href="<?php echo site_url('register/login') ?>">Connexion</a>
                    </li>
                </ul>

            </ul>
        </div>
    </nav>


    <h2>Mot de passe oublié ?</h2>

    <?php
        if($this->session->flashdata("email-ok")){
            echo
                '<div class="ok-messages">'
                    .$this->session->flashdata("email-fail").
                '</div>';
        }

        if($this->session->flashdata("email-ok")){
            echo
                '<div class="alerte-messages-connexion">'
                    .$this->session->flashdata("email-fail").
                '</div>';
        }
     ?>




    <?php echo form_open_multipart(); ?>
        <div class="connexion-form">

              <div class="form-group">
                  <label class="lab-input">Email :</label>
                  <input type="email" class="form-control sub" name="email">
              </div>

              <button type="submit" class="btn btn-primary submit">Réinitialiser</button>
            </form>

        </div>
    </form>





    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- js scripts -->
</body>

</html>
