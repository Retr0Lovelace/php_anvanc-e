<?php session_start();?>
<?php require_once '../Model/Functions.php';?>
<?php unset($_SESSION['errors']);?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>PHP - Anvancée</title>
</head>
<body>
<?php $Functions = new Functions();
$data = $Functions->fetchDep();
$data_user = $Functions->FetchUserInfo($_GET['id']);
?>
<form style="display: flex;flex-direction: column;justify-content: center;" action="../traitement/traitement_modification.php" method="post">
    <style>form > input,form > select{width: 25%;margin: 15px 0px;}</style>
    <input name="id" hidden value="<?= $_GET['id']?>" required>
    <label for="mail">Mail:</label>
    <input type="email" name="mail" id="mail" value="<?= $data_user['mail_user'] ?>" required>
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" value="" required>
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" value="<?= $data_user['nom_user'] ?>" required>
    <label for="prenom">Nom:</label>
    <input type="text" name="prenom" id="prenom" value="<?= $data_user['prenom_user'] ?>" required>
    <label for="Birth">Date de naissance:</label>
    <input type="datetime-local" id="Birth" name="Birth" required>
    <label for="Departement">Département de Naissance:</label>
    <select id class="js-example-basic-single" id="Departement" name="Departement" required>
        <option value="<?= $data_user['Departement_user'] ?>" selected><?= $data_user['Departement_user'] ?></option>
        <?php for ($i=0;$i < count($data);$i++):?>
            <option value="<?= $data[$i]['code'].' - '.$data[$i]['nom'] ?>"><?= $data[$i]['code'].' - '.$data[$i]['nom'] ?></option>
        <?php endfor; ?>
    </select>
    <input type="submit" value="Modifier">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
