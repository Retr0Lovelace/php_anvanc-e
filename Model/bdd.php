<?php

class bdd
{
    private $bdd;

    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=phpavancé;charset=utf8', 'root', '');
            $this->bdd->exec('SET CHARACTER SET utf8');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }

    public function getStart(){
        return $this->bdd;
    }

}