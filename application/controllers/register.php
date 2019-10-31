<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller {

    public function subscribe(){

        $this->load->model('register_model');

        //register form rules :
        $this->form_validation->set_rules('prenom_Proprietaire', 'prénom', 'required', array('required' => 'Votre %s est indispensable pour l\'inscription.'));
        $this->form_validation->set_rules('nom_Proprietaire', 'nom', 'required', array('required' => 'Votre %s est indispensable pour l\'inscription.'));
        $this->form_validation->set_rules('mail_Proprietaire', 'email', 'required|valid_email|is_unique[proprietaire.mail_Proprietaire]', array('required|valid_email|is_unique[proprietaire.mail_Proprietaire]' => 'Votre %s doit être unique et valide'));
        $this->form_validation->set_rules('age_Proprietaire', 'date de naissance', 'required', array('required' => 'Votre %s est indispensable pour l\'inscription.'));
        $this->form_validation->set_rules('pw_Proprietaire', 'mot de passe', 'required', array('required' => 'Votre %s est indispensable pour l\'inscription.'));
        $this->form_validation->set_rules('pw_confirm', 'mot de passe', 'trim|required|matches[pw_Proprietaire]', array('required' => 'Votre %s doit être le meme dans les deux champs'));

        // if form_validation is ok, we load the method subscribe,
        // if not, we display the subscribe form with the errors.
        if($this->form_validation->run() == TRUE) {

              $data = $this->input->post();

              //load library
              $this->load->library('Phpmailer_lib');

              //create new mail object
              $mail = $this->phpmailer_lib->load();

              // setup SMTP
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'jimmy.bbbrk@gmail.com';
              $mail->Password = 'eterlol525';
              $mail->SMTPSecure = 'tls';
              $mail->Port = 587;
              $mail->iSHtml(true);

              $mail->setFrom('jimmy.bbbrk@gmail.com', 'Safy');

              // Add a recipient
              $mail->addAddress($data['mail_Proprietaire']);

              // Email subject
              $mail->Subject = 'Inscription a Safy';

              // Email body content
              $mailContent = "<h1>Bonjour ".$data['prenom_Proprietaire']."</h1>
                  <p>Bienvenu sur Safy, l'application qui facilite la vie des motards !";
              $mail->Body = $mailContent;

              // Send email
              if(!$mail->send()){
                  echo 'Message could not be sent.';
                  echo 'Mailer Error: '.$mail->ErrorInfo;
              }else{
                $this->register_model->register();
                $this->session->set_flashdata("inscription", "Vous êtes maintenant inscrit, un email vous a été ernvoyé, vous pouvez vous connecter pour acceder à votre espace.");
                redirect(site_url("register/login"));
              }
          }
          else{
              $this->session->set_flashdata("email-fail", "Une erreur s'est produite");
              $this->load->view('sub_form'); //+ passer un message d'erreur
          }
      }

 /* -------------------------------------------------------------------- */

    public function login(){

        $this->load->model('register_model');

        if ($data = $this->input->post())
        {
            $email = $data['email'];
            $password = $data['password'];
            $user = $this->register_model->login($email);

            if($user){
                if (password_verify($password, $user->pw_Proprietaire)) {
                    $this->session->user = $user;
                    redirect(site_url("safy/userindex"));
                }
                else{
                    $this->session->user = null;
                    $this->session->set_flashdata("message", "Le mot de passe ne correspond pas avec l'email");
                    redirect(site_url("register/login"));
                    }
            }
            else{
                $this->session->user = null;
                $this->session->set_flashdata("message", "Le mot de passe ne correspond pas avec l'email");
                redirect(site_url("register/login"));
            }
        }
        else{
            $this->load->view('connexion_form');
        }
    }

    /* -------------------------------------------------------------------- */

    public function logout(){

        $this->session->user = null;
        redirect(site_url("safy/index"));
    }

    /* -------------------------------------------------------------------- */

    public function reset_password($id){

        if ($data = $this->input->post()){

            $data['id'] = $id;

            if ($data['newPassword'] === $data['confirmPassword']) {

                $this->load->model('register_model');
                $this->register_model->reset_password($data);

                $this->session->set_flashdata("pw_changed", "Votre nouveau mot de passe a bien été enregistré");
                $this->load->view('connexion_form');
            }
            else{
                $this->load->view('reset_password_view'); // mettre une alerte mdp pas les meme
            }
        }
        else{
            $this->load->view('reset_password_view');
        }
    }

/* -------------------------------------------------------------------- */

    public function reset_password_email(){

        if ($data = $this->input->post()){
            $this->load->model('register_model');
            $result = $this->register_model->email_exist($data['email']);

            if ($result != false){

                //load library
                $this->load->library('Phpmailer_lib');

                //create new mail object
                $mail = $this->phpmailer_lib->load();

                // setup SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jimmy.bbbrk@gmail.com';
                $mail->Password = 'eterlol525';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->iSHtml(true);

                $mail->setFrom('jimmy.bbbrk@gmail.com', 'Safy');

                // Add a recipient
                $mail->addAddress($result->mail_Proprietaire);

                // Email subject
                $mail->Subject = 'Mot de passe oublié ?';

                // Email body content
                $mailContent = "<h1>Bonjour ".$result->prenom_Proprietaire."</h1>
                    <p>Il semblerait que vous ayez oublié votre mot de passe, pour en créer un nouveau, <a href='".site_url('register/reset_password/'.$result->id_Proprietaire)."'>Cliquez sur ce lien</a></p>";
                $mail->Body = $mailContent;

                // Send email
                if(!$mail->send()){
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: '.$mail->ErrorInfo;
                }else{
                    $this->session->set_flashdata("email-ok", "Un e-mail vous a été envoyé.");
                    $this->load->view('reset_password_email');
                }
            }
            else{
                $this->session->set_flashdata("email-fail", "Une erreur s'est produite");
                $this->load->view('reset_password_email');
            }
        }
        else{
            $this->load->view('reset_password_email');
        }
    }
}

?>
