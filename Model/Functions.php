<?php

require_once 'user.php';
require_once 'bdd.php';

class Functions
{
    private $recherche;
    private $donne;
    private $req;
    private $id;

    public function Errors(Utilisateur $user){

        $_SESSION['errors'] = [];

        if (!empty($this->getDonne())) {
            array_push($_SESSION['errors'],"Votre Username/Mail est déjà utilisé");
        }

        if (empty($user->getNomUser()) || !preg_match('/^[a-zA-Z0-9_]+$/', $user->getNomUser())) {
            array_push($_SESSION['errors'],"Votre nom n'est pas alphanumérique");
        }

        if (empty($user->getPrenomUser()) || !preg_match('/^[a-zA-Z0-9_]+$/', $user->getPrenomUser())) {
            array_push($_SESSION['errors'],"Votre nom n'est pas alphanumérique");
        }

        if (empty($user->getMailUser() || !filter_var($user->getMailUser(), FILTER_VALIDATE_EMAIL))) {
            array_push($_SESSION['errors'],"Votre mail n'est pas valide");
        }

        if (empty($user->getDepartementUser())) {
            array_push($_SESSION['errors'],"Le Département n'a pas été renseigné");
        }

        if (empty($_SESSION['errors'])){
            unset($_SESSION['errors']);
        }
    }

    public function setDonne($donne)
    {
        $this->donne = $donne;
    }

    public function getDonne()
    {
        return $this->donne;
    }

    public function setRecherche($recherche)
    {
        $this->recherche = $recherche;
    }

    public function getRecherche()
    {
        return $this->recherche;
    }

    public function setReq($req)
    {
        $this->req = $req;
    }

    public function getReq()
    {
        return $this->req;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function fetchUser(){
        $bdd = new bdd();

        $req=$bdd->getStart()->prepare('SELECT id_user,nom_user,prenom_user,mail_user,Birth_user,Departement_user FROM users');
        $req->execute();
        $donne = $req->fetchAll();

        return $donne;
    }

    public function FetchUserInfo($id){
        $bdd = new bdd();

        $req=$bdd->getStart()->prepare('SELECT id_user,nom_user,prenom_user,mail_user,Birth_user,Departement_user FROM users WHERE id_user = :id_user');
        $req->execute(array(
            'id_user'=> $id
        ));
        $donne = $req->fetch();

        return $donne;
    }

    public function fetchCom(int $code){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://geo.api.gouv.fr/departements/'.$code.'/communes?fields=nom,code,codesPostaux,population&format=json&geometry=centre',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        return $response;
    }

    public function fetchDep(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://geo.api.gouv.fr/departements',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl), true);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        return $response;
    }
}
