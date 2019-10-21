<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class moto extends CI_Controller {



        //-------------------------------------------------------------
        /**
        * \brief function permettant l'ajout d'une nouvelle moto pour l'utilisateur connecté
        * \param donnée de la moto ajoutée $data reccupéré dans le formulaire d'ajout
        * \author Gressier J
        * \date 07/06/2019
        */
        public function ajout(){

            if ($data = $this->input->post()) {

                // la date modif est dans ce cas la date de creation de la moto
                $data['date_modif'] = date('Y-m-d');
                $this->load->model('moto_model');

                $this->moto_model->ajout($data);

                $aData['moto'] = $this->moto_model->get_moto_user();

                $this->load->view('userindex', $aData);
            }
            else{

                $this->load->model('moto_model');

                $aView['marque'] = $this->moto_model->get_marque();

                $this->load->view('ajout', $aView);
            }

        }

        /* -------------------------------------------------------------------- */

        public function get_modele_json($marqueId){

            $this->load->model('moto_model');

            $modeles = $this->moto_model->get_modele($marqueId);

            $this->output->set_content_type('application/json');
            $this->output->set_status_header(200);
            $this->output->set_output(json_encode($modeles));
        }

        /* -------------------------------------------------------------------- */

        public function detail_moto($id_Moto){
            $this->load->model('moto_model');

                if ($this->input->post()) {


                //  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

                    //Reccupere l'extension du fichier
                    $name = $_FILES["myfile"]['name'];
                    $file_ext = pathinfo($name, PATHINFO_EXTENSION);

                    //supprime et remplace le ficher photo si le nom est le meme mais l'extension est differente
                    switch($file_ext){
                        case $file_ext == "gif":
                            unlink('./assets/images/photo_user/'.$id_Moto.'.jpg');
                            unlink('./assets/images/photo_user/'.$id_Moto.'.png');
                            break;

                        case $file_ext == "jpg":
                            unlink('./assets/images/photo_user/'.$id_Moto.'.gif');
                            unlink('./assets/images/photo_user/'.$id_Moto.'.png');
                            break;

                        case $file_ext == "png":
                            unlink('./assets/images/photo_user/'.$id_Moto.'.jpg');
                            unlink('./assets/images/photo_user/'.$id_Moto.'.gif');
                            break;
                    }


                    $config['upload_path'] = './assets/images/photo_user';
                    $config['file_name'] = $id_Moto.'.'.$file_ext;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '1024';
                    $config['max_width']  = '1024';
                    $config['max_height']  = '768';


                    $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('myfile')) {

                                $errors = array('error' => $this->upload->display_errors());

                                $aView["errors"] = $errors;

                                echo $aView["errors"];

                            }

                        redirect('moto/detail_moto/'.$id_Moto);

                }

                // va chercher les noms, dates modif, id, nom marque et km moto
                $aData['moto'] = $this->moto_model->get_moto_detail($id_Moto);

                $aData['operation'] = $this->moto_model->get_type_operation();

                //va chercher l'historique de la moto de la page detail
                $aData['historique'] = $this->moto_model->get_historique($id_Moto);

                $lifetime = $this->moto_model->lifetime($id_Moto);
                // GET THE CURRENT KM TO USE IT AS PARAM ON FOLLOWING FUNCTIONS
                $current_km = $aData['moto'][0]->km_Moto;

                $date_circu = $aData['moto'][0]->date_circu_Moto;




                $this->load->library('Fonctions');



                $vidange = $this->fonctions->convert($lifetime["vidange"], $current_km);
                $pneuAvantKm = $this->fonctions->convert($lifetime["pneu_avant"], $current_km);
                $pneuArriereKm = $this->fonctions->convert($lifetime["pneu_arriere"], $current_km);
                $kitChaineKm = $this->fonctions->convert($lifetime["kit_chaine"], $current_km);
                $plaquetteAvantKm = $this->fonctions->convert($lifetime["plaquette_avant"], $current_km);
                $plaquetteArriereKm = $this->fonctions->convert($lifetime["plaquette_arriere"], $current_km);




                $aData['vid'] = $this->fonctions->calc_vidange($vidange, $current_km);

                $aData['purge'] = $this->fonctions->calc_purge($lifetime["purge_frein"], $date_circu);

                $aData['plaqAv'] = $this->fonctions->calc_plaquette($plaquetteAvantKm, $current_km);

                $aData['plaqArr'] = $this->fonctions->calc_plaquette($plaquetteArriereKm, $current_km);

                $aData['kitChaine'] = $this->fonctions->calc_kitChaine($kitChaineKm, $current_km);

                $aData['pneuAv'] = $this->fonctions->calc_pneuAv($pneuAvantKm, $current_km);

                $aData['pneuArr'] = $this->fonctions->calc_pneuArr($pneuArriereKm, $current_km);



                //var_dump($aData); exit;
                $this->load->view('detail_moto', $aData);

        }


        public function ajout_operation(){

            $this->load->model('moto_model');

            $historique = $this->input->post();


            //TEMPORAIRE LE TEMPS DE L'AJOUT DE LA FONCTION
            unset($historique['myfile']);
            $this->moto_model->ajout_operation($historique);

            redirect('moto/detail_moto/'.$historique['id_moto']);

        }



// }

    /* -------------------------------------------------------------------- */

        public function maj_km(){

            //FORM RULES :
            // $this->form_validation->set_rules('km_Moto', 'kilometrage', 'numeric', array('required' => 'Entrer le %s est indispensable pour la mise à jour.'));
            //
            // if($this->form_validation->run() == TRUE){

            $this->load->model('moto_model');

            $km = $this->input->post();

            $id_Moto = $km['id_moto'];

            unset($km['id_moto']);

            $this->moto_model->maj_km($km, $id_Moto);

             redirect('moto/detail_moto/'.$id_Moto);

            //}

            // else{
            //
            //     $this->output->set_content_type('application/json');
            //     $this->output->set_status_header(200);
            //     $this->output->set_output(json_encode(validation_errors()));
            //
            // }

        }

    /* -------------------------------------------------------------------- */

        public function historique($id_Moto){

            $this->load->model('moto_model');

            $historique = $this->moto_model->get_historique($id_Moto);

            $this->output->set_content_type('application/json');
            $this->output->set_status_header(200);
            $this->output->set_output(json_encode($historique));

        }

    /* -------------------------------------------------------------------- */


        public function delete_historique($id_historique){

            $this->load->model('moto_model');
            $this->moto_model->delete_historique($id_historique);
            redirect('safy/userindex/');

        }


    /* -------------------------------------------------------------------- */

        public function modif_historique($id_operation){


            if ($data = $this->input->post()) {

            $this->load->model('moto_model');
            $this->moto_model->modif_historique($id_operation, $data);

            redirect('moto/detail_moto/'.$data['id_Moto']);
            }
        }


    /* -------------------------------------------------------------------- */

        public function delete_moto($id_Moto){

            $this->load->model('moto_model');

            $this->moto_model->delete_moto($id_Moto);
            redirect('safy/userindex/');
        }



    }

?>
