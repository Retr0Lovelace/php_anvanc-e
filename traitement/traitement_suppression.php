<?php

require_once '../model/manager.php';

$co = new manager();
$co->Supression($_GET['id']);