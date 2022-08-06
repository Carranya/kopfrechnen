<DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Kopfrechnen</title>
</head>
<body>
    <h2>Kopfrechnen Übung</h2>
<?php
include "kopfrechnen_main.php";

$name = htmlentities($_POST["name"]);
$anzahl = htmlentities($_POST["anzahl"]);
$level = $_POST["level"];

$rechnen = new Formular($name, $anzahl, $level);
$rechnen->anzeigen();
$rechnen->save();
?>
</body>
</html>
