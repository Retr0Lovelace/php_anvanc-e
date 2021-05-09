<?php

require_once '../model/user.php';
require_once '../model/manager.php';

$user = new Utilisateur(array(
    'mailuser' => $_POST['mail'],
    'passworduser'=> $_POST['password'],
));

$co = new manager();
$co->Connexion($user);
