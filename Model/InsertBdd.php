<?php

class ReleveDb {
    public function CreateBdd() {
        $req = $bdd->prepare('INSERT INTO data(temp, humidity)'.' VALUES(:temp, :humidity)');
        
        if ($temp!='' && $humidity!=''){
            $req->execute(array(
                'temp'=>$temp,
                'humidity'=>$humidity
                
            )
                );
        }
    }
}
        
        


