<?php

require_once '../model/user.php';
require_once '../model/manager.php';

$user = new Utilisateur(array(
    'iduser'=> $_POST['id'],
    'mailuser' => $_POST['mail'],
    'passworduser'=> $_POST['password'],
    'nomuser' => $_POST['nom'],
    'prenomuser' => $_POST['prenom'],
    'Birthuser' => $_POST['Birth'],
    'Departementuser' => $_POST['Departement']
));

$co = new manager();
$co->Modification($user);