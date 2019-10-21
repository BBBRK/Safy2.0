<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Safy extends CI_Controller {

/* -------------------------------------------------------------------- */

    public function index(){
        $this->load->view('index');
    }

/* -------------------------------------------------------------------- */

    public function userindex(){
        $this->load->model('moto_model');
        $aData['moto'] = $this->moto_model->get_moto_user();
        $this->load->view('userindex', $aData);
    }

/* -------------------------------------------------------------------- */

}

?>
