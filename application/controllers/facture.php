<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class facture extends CI_Controller {


        public function ajout(){

            $this->load->model('facture_model');

            if ($this->input->post()) {

                $id_moto = $_POST['id_moto'];

                $finalName = $_POST['id_histo'];

                //Reccupere l'extension du fichier
                $name = $_FILES['facture']['name'];
                $file_ext = pathinfo($name, PATHINFO_EXTENSION);


                //supprime et remplace le ficher photo si le nom est le meme mais l'extension est differente
                switch($file_ext){
                    case $file_ext == "gif":
                        unlink('./assets/images/factures/'.$finalName.'.jpg');
                        unlink('./assets/images/factures/'.$finalName.'.png');
                        break;

                    case $file_ext == "jpg":
                        unlink('./assets/images/factures/'.$finalName.'.gif');
                        unlink('./assets/images/factures/'.$finalName.'.png');
                        break;

                    case $file_ext == "png":
                        unlink('./assets/images/factures/'.$finalName.'.jpg');
                        unlink('./assets/images/factures/'.$finalName.'.gif');
                        break;
                }


                $config['upload_path'] = './assets/images/factures';
                $config['file_name'] = $finalName.'.'.$file_ext;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = TRUE;
                $config['max_size'] = '1024';
                $config['max_width']  = '1024';
                $config['max_height']  = '768';


                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('facture')) {

                        $errors = array('error' => $this->upload->display_errors());

                        $aView["errors"] = $errors;

                        echo $aView["errors"];

                    }

                redirect('moto/detail_moto/'.$id_moto);

                }

        }


}
