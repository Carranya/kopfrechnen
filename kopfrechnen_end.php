<DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Kopfrechnen</title>
    <link rel="stylesheet" href="format.css">
</head>
<body>
    <h2>Kopfrechnen Übung</h2>
<?php
include "kopfrechnen_main.php";

$z = file_get_contents("kopfrechnen.dat");
$rechnen = unserialize($z);
$rechnen->auswerten($_POST['eingabe']);
?>
<form action="index.htm" method="post">
<p><input type="submit" value="Nochmals?"></p>
</form>
</body>
</html>
