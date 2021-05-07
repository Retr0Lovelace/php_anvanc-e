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
$data = $method->fetchUser();
?>

<link href="css/select2.min.css" rel="stylesheet" />
<script src="js/select2.min.js"></script>
</body>
</html>