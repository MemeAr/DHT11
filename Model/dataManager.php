<?php

require 'connDatabase.php';

class DataManager extends Manager{
    public function setData() {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO data(temp, humidity)'.' VALUES(:temp, :humidity)');
        
        if ($temp!='' && $humidity!=''){
            $req->execute(array(
                'temp'=>$temp,
                'humidity'=>$humidity 
            )
                );
        }
    }
    public function getData($date){
        $bdd= $this->dbConnect();
        
        $req = $bdd->prepare('SELECT * FROM temp, humidity, date FROM data where date = :date');
        
        $req->bindParam(":date", $date);
       
        if ($req->execute()) {
        
            if ($releveRow = $req->fetch()) {
                
                $releve = new Releve();
                
                $releve->temp = $releveRow['temp'];
                
                $releve->humidity = $releveRow['humidity'];
                
                $releve->date = $releveRow['date'];
            }
        }
        return $releve;
    }
}
        
        


