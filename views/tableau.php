<?php session_start();?>
<?php require_once '../Model/Functions.php';?>
<?php
function calculAge(string $birthDate)
{
    $birth = new DateTime($birthDate);
    $current = new DateTime('now');
    $interval = $birth->diff($current);
    return $interval->format('%Y');
}
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
<?php $Functions = new Functions();
$data = $Functions->fetchUser(); ?>
<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Mail</th>
        <th>Age</th>
        <th>Département</th>
        <th>Modifier</th>
        <th>Supprimer</th>
        <th>Afficher communes</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $value):?>
    <tr>
        <td><?= $value['id_user'] ?></td>
        <td><?= $value['nom_user'] ?></td>
        <td><?= $value['prenom_user'] ?></td>
        <td><?= $value['mail_user'] ?></td>
        <td><?= calculAge($value['Birth_user']) ?></td>
        <td><?= $value['Departement_user'] ?></td>
        <td><a href="modify.php?id=<?= $value['id_user'] ?>"><button>Modifier</button></a></td>
        <td><a onclick="toggleConfirm()"><button>Supprimer</button></a></td>
        <td><a href="Commune.php?commune=<?= $value['Departement_user'] ?>"><button>Afficher</button></a></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Mail</th>
        <th>Age</th>
        <th>Département</th>
        <th>Modifier</th>
        <th>Supprimer</th>
        <th>Afficher communes</th>
    </tr>
    </tfoot>
</table>
<a href="../traitement/traitement_leave.php"><button>Déconnexion</button></a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="../js/script.js"></script>
<script type="text/javascript" language="javascript">
    function toggleConfirm(){
        if (confirm("Vous désirez vraiment quitter?")) {
            window.location.href='../traitement/traitement_suppression.php?id=<?= $value['id_user'] ?>';
        }
    }
</script>
</body>
</html>