<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class facture extends CI_Controller {


        public function ajout($id_Moto){

            $this->load->model('facture_model');

            if ($this->input->post()) {

                echo "cccc";
                var_dump($_FILES);
                var_dump($_POST);
                var_dump($id_Moto);
                exit;

                $finalName = $_POST;

                //Reccupere l'extension du fichier
                $name = $_FILE['facture']['name'];
                $file_ext = pathinfo($name, PATHINFO_EXTENSION);


                $config['upload_path'] = './assets/images/factures';
                $config['file_name'] = $finalName.'.'.$file_ext;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = TRUE;
                $config['max_size'] = '10240';
                $config['max_width']  = '10240';
                $config['max_height']  = '7680';


                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('facture')) {

                        $errors = array('error' => $this->upload->display_errors());

                        $aView["errors"] = $errors;

                        echo $aView["errors"];

                    }

                redirect('moto/detail_moto/'.$id_Moto);

                }

        }


}
