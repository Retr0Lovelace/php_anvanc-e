<?php session_start();?>
<?php unset($_SESSION['errors']); ?>
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
        <form style="display: flex;flex-direction: column;justify-content: center;" action="traitement/traitement_connexion.php" method="post">
            <style>form > input,form > select{width: 25%;margin: 15px 0px;}</style>
            <input type="email" name="mail" placeholder="Mail">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Se connecter">
        </form>
        <a href="views/register.php">S'inscrire</a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
