<?php session_start();?>
<?php require_once '../Model/Functions.php';?>
<?php
$_GET['commune'] = filter_var($_GET['commune'], FILTER_SANITIZE_NUMBER_INT);
$_GET['commune'] = str_replace('-', '', $_GET['commune']);
$_GET['commune'] = (int)$_GET['commune'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <title>PHP - Anvancée</title>
</head>
<body>
<?php
$Functions = new Functions();
$data = $Functions->fetchCom($_GET['commune']);
?>
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Nom Commune</th>
        <th>Code postal</th>
        <th>Population</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $value):?>
        <tr>
            <td><?= $value['nom'] ?></td>
            <td><?= $value['codesPostaux'][0] ?></td>
            <td><?= $value['population'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>Nom Commune</th>
        <th>Code postal</th>
        <th>Population</th>
    </tr>
    </tfoot>
</table>
<a href="../views/tableau.php"><button>Retour Tableau</button></a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>