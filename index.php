<?php session_start();?>
<?php require_once 'method.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP - Anvancée</title>
</head>
<body>
    <?php $method = new Method();
    $data = $method->fetchDep();
    ?>
        <form style="display: flex;flex-direction: column;justify-content: center;" action="traitement/traitement_register.php" method="post">
            <style>form > input,form > select{width: 25%;margin: 15px 0px;}</style>
            <input type="email" name="mail" placeholder="Mail">
            <input type="password" name="password" placeholder="Password">
            <input type="text" name="nom" placeholder="nom">
            <input type="text" name="prenom" placeholder="prenom">
            <input type="date" name="Birth" placeholder="Date de naissance">
            <select>
                <option value="" disabled selected>Département de naissance</option>
                <?php for ($i=0;$i < count($data);$i++): ?>
                <option value="<?= $data[$i]['code'].' - '.$data[$i]['nom'] ?>"><?= $data[$i]['code'].' - '.$data[$i]['nom'] ?></option>
                <?php endfor; ?>
            </select>
            <input type="submit" value="S'inscrire">
        </form>
</body>
</html>
