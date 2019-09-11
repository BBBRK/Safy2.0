<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class moto_model extends CI_Model {




        public function ajout($data){

            $data['id_Proprietaire'] = $this->session->user->id_Proprietaire;
            unset($data['marqueId']);

            $this->db->insert("moto", $data);
        }

/* -------------------------------------------------------------------- */

        public function get_marque(){

            $requete = $this->db->query("SELECT *
                                         FROM marque");
            return $requete->result();
        }

/* -------------------------------------------------------------------- */

        public function get_modele($marqueId){

            $requete = $this->db->query("SELECT *
                                         FROM modele
                                         WHERE id_Marque= ?", array($marqueId));
            $result = $requete->result();

            return $result;
        }

/* -------------------------------------------------------------------- */

        public function get_moto_user(){

            $userId = $this->session->user->id_Proprietaire;

            $requete = $this->db->query("SELECT nom_Modele, date_modif, id_Moto
                                         FROM modele
                                         JOIN moto
                                         ON modele.id_Modele = moto.id_Modele
                                         WHERE id_Proprietaire= ?", array($userId));

            $result = $requete->result();

            return $result;

        }

 /* -------------------------------------------------------------------- */

 public function get_moto_detail($id_Moto){

     $userId = $this->session->user->id_Proprietaire;

     $requete = $this->db->query("SELECT nom_Modele, date_modif,
                                         id_Moto, nom_Marque,
                                         km_Moto, date_circu_Moto
                                  FROM modele
                                  JOIN moto
                                  ON modele.id_Modele = moto.id_Modele
                                  JOIN marque
                                  ON modele.id_Marque = marque.id_Marque
                                  WHERE id_Moto= ?", array($id_Moto));

     $result = $requete->result();

     return $result;

    }

    /* -------------------------------------------------------------------- */

    public function get_type_operation(){

        $requete = $this->db->query("SELECT *
                                     FROM operation");
        return $requete->result();

    }

    /* -------------------------------------------------------------------- */

    public function ajout_operation($historique){



        $this->db->insert("historique", $historique);

    }

    /* -------------------------------------------------------------------- */

    public function maj_km($km, $id_Moto){

        $this->db->set('km_Moto', $km);
        $this->db->update('moto', $km, "id_Moto=$id_Moto");

        // mise à jour de la date de derniere modification

        $date['date_modif'] = date('Y-m-d');

        $this->db->where('id_Moto', $id_Moto);
        $this->db->update('moto', $date);

    }

    /* -------------------------------------------------------------------- */

    // public function get_historique($id_Moto){
    //
    //     $requete = $this->db->query("SELECT *
    //                                  FROM historique
    //                                  WHERE id_Moto=?", array($id_Moto));
    //
    //     return $requete->result();
    //
    // }

    public function get_historique($id_Moto){

        $requete = $this->db->query("SELECT historique.description, historique.date_operation, historique.km, historique.prix, historique.id, operation.type
                                     FROM historique
                                     JOIN operation
                                     ON historique.id_operation = operation.id
                                     WHERE id_Moto=?", array($id_Moto));


        return $requete->result();

    }



    /* -------------------------------------------------------------------- */

    public function modif_historique($id_operation, $data){

        $description = $data['description'];
        $date_operation = $data['date_operation'];
        $prix = $data['prix'];
        $km = $data['km'];

        $requete = $this->db->query("UPDATE Historique
                                     SET description = '$description',
                                         date_operation = '$date_operation',
                                         prix = $prix,
                                         km = $km
                                     WHERE id=?", array($id_operation));
    }

    /* -------------------------------------------------------------------- */

    public function delete_historique($id_historique){

        $this->db->where('id', $id_historique);
        $this->db->delete('historique');

    }

    /* -------------------------------------------------------------------- */

    public function delete_moto_historique($id_moto){

        $this->db->where('id_moto', $id_moto);
        $this->db->delete('historique');

    }

    /* -------------------------------------------------------------------- */

    public function delete_moto($id_Moto){

        $this->delete_moto_historique($id_Moto);

        $this->db->where('id_Moto', $id_Moto);
        $this->db->delete('moto');
    }

    /* -------------------------------------------------------------------- */

    public function lifetime($id_Moto){

        $requete = [];

        $vidange = $this->db->query("SELECT MAX(km) as maxkm
                                     FROM historique
                                     WHERE id_operation=2
                                     AND id_moto=?",
                                     array($id_Moto));

        $requete['vidange'] = $vidange->row();


        /* ------- */

        $purge_frein = $this->db->query("SELECT MAX(date_operation) as maxdate
                                         FROM historique
                                         WHERE id_operation=3
                                         AND id_moto=?",
                                         array($id_Moto));

        $requete['purge_frein'] = $purge_frein->row();

        /* ------- */

        $pneu_avant = $this->db->query("SELECT MAX(km) as maxkm
                                        FROM historique
                                        WHERE id_operation=4
                                        AND id_moto=?",
                                        array($id_Moto));

        $requete['pneu_avant'] = $pneu_avant->row();

        /* ------- */

        $pneu_arriere = $this->db->query("SELECT MAX(km) as maxkm
                                          FROM historique
                                          WHERE id_operation=5
                                          AND id_moto=?",
                                          array($id_Moto));

        $requete['pneu_arriere'] = $pneu_arriere->row();

        /* ------- */

        $kit_chaine = $this->db->query("SELECT MAX(km) as maxkm
                                        FROM historique
                                        WHERE id_operation=6
                                        AND id_moto=?",
                                        array($id_Moto));

        $requete['kit_chaine'] = $kit_chaine->row();

        /* ------- */

        $plaquette_avant = $this->db->query("SELECT MAX(km) as maxkm
                                            FROM historique
                                            WHERE id_operation=7
                                            AND id_moto=?",
                                            array($id_Moto));

        $requete['plaquette_avant'] = $plaquette_avant->row();

        /* ------- */

        $plaquette_arriere = $this->db->query("SELECT MAX(km) as maxkm
                                                FROM historique
                                                WHERE id_operation=8
                                                AND id_moto=?",
                                                array($id_Moto));

        $requete['plaquette_arriere'] = $plaquette_arriere->row();




        return $requete;




    }


}






 ?>
