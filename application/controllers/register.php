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

            $this->register_model->register();
            $this->session->set_flashdata("inscription", "Vous êtes maintenant inscrit, vous pouvez vous connecter pour acceder à votre espace.");
            redirect(site_url("register/login"));
        }
        else{

            $this->load->view('sub_form');
        }

    }


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



    public function logout(){

        $this->session->user = null;
        redirect(site_url("safy/index"));
    }











}

?>
