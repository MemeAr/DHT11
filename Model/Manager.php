<?php

require_once 'config.inc.php';

class Manager {
    protected function dbConnect() {
        return new \PDO('mysql:host=localhost;dbname=dht11;charset=utf8', 'root', 'Password123!');
    }
}