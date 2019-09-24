<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class register_model extends CI_Model {


        public function register(){

            // password encryption
            $data = $this->input->post();
            $data['pw_Proprietaire'] = password_hash($data['pw_Proprietaire'], PASSWORD_DEFAULT);



            unset($data['verification_key']);

            //calc of the owner age
            $birth = $data['age_Proprietaire'];
            $age = (time() - strtotime($birth)) / 3600 / 24 / 365;
            $age = floor($age);
            $data['age_Proprietaire'] = $age;


            unset($data['pw_confirm']); //permet que le champ ne soit pas entrer en DB
            $this->db->insert("proprietaire", $data);
            return $this->db->insert_id();

        }


        public function login($email){

            $user = $this->db->query("SELECT * FROM proprietaire WHERE mail_Proprietaire=?", $email)->row();

            return $user;
        }


        public function email_exist($email){


            $result = $this->db->query("SELECT mail_Proprietaire, prenom_Proprietaire FROM proprietaire WHERE mail_Proprietaire= ?", $email);


            // $result = $this->db->query($sql);
            $row = $result->row();

            var_dump($row);
            exit;

            if ($row->num_row() === 1 && $row->mail_Proprietaire) {
                var_dump('C BON');
                exit;
            }
            else {
                var_dump('C PAS BON');
                exit;
            }


        }







    }



 ?>
