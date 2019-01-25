<?php

class Thermometre {
    public function thermoData(){
        $donnees = file_get_contents('data.json');
        $info = json_decode($donnees);
        
        $bargraph_height = 161 + $info->temperature * 4;
        $bargraph_top = 315 - $info->temperature * 4;
    }
}