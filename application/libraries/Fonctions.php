<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fonctions{


        //convert result of db request string into int to calculate the lifetime left of wearing parts
        public function convert($var, $current_km)
        {

          if ($var != null) {
            return (int)$var->maxkm;
          }
          else{
            return $current_km; 
          }

        }

        /* ------- */

        //calc lifetime left of vidange
        public function calc_vidange($kmChangement, $current_km){

            $kmMoyVidange = 6000;

            $currentKmVid = $current_km - $kmChangement;

            $resultVidange = (100 * $currentKmVid) / $kmMoyVidange;

            $result = floor($resultVidange);

            return $result;
        }

        /* ------- */

        //calc lifetime left of brake pad
        public function calc_plaquette($kmChangement, $current_km){

            $kmMoyPlaquette = 20000;

            $currentKmPlaq = $current_km - $kmChangement;

            $resultPlaquette = (100 * $currentKmPlaq) / $kmMoyPlaquette;

            $result = floor($resultPlaquette);

            return $result;
        }

        /* ------- */

        //calc lifetime left purge des freins
        public function calc_purge($dateLastvid, $miseCircu){


            if ($dateLastvid->maxdate != null) {

                $currentDate = date('Y-m-d');
                $jourMoyPurge = 730; // 2 years in days

                $dateDiff = date_diff(date_create($currentDate), date_create($dateLastvid->maxdate));

                $resultPurge = (100 * $dateDiff->days) / $jourMoyPurge;

                $result = floor($resultPurge);

                return $result;
            }
            else{

                $currentDate = date('Y-m-d');
                $jourMoyPurge = 730; // 2 years in days

                $dateDiff = date_diff(date_create($currentDate), date_create($miseCircu));

                $resultPurge = (100 * $dateDiff->days) / $jourMoyPurge;

                $result = floor($resultPurge);

                return $result;
            }



            $currentDate = date('Y-m-d');

            $dateDiff = date_diff(date_create($currentDate), date_create($miseCircu));

            $jourMoyPurge = 730; // 2 ans en jours

            $resultPurge = (100 * $dateDiff->days) / $jourMoyPurge;

            $result = floor($resultPurge);

            return $result;
        }

        /* ------- */

        public function calc_kitChaine($kmChangement, $current_km){

            $kmMoyKitChaine = 20000;

            $currentKmKit = $current_km - $kmChangement;

            $resultKit = (100 * $currentKmKit) / $kmMoyKitChaine;

            $result = floor($resultKit);

            return $result;
        }

        /* ------- */

        public function calc_pneuAv($kmChangement, $current_km){

            $kmMoyPneu = 12000;

            $currentKmPneu = $current_km - $kmChangement;

            $resultPneu = (100 * $currentKmPneu) / $kmMoyPneu;

            $result = floor($resultPneu);

            return $result;
        }

        /* ------- */

        public function calc_pneuArr($kmChangement, $current_km){

            $kmMoyPneu = 10000;

            $currentKmPneu = $current_km - $kmChangement;

            $resultPneu = (100 * $currentKmPneu) / $kmMoyPneu;

            $result = floor($resultPneu);

            return $result;
        }



}
