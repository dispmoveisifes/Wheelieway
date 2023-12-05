<?php
require("pdoConnect.php");

$consulta = $db->prepare("SELECT * FROM USUARIO WHERE email = 'ma@gmail.com'");
if($consulta->execute()) var_dump($consulta->fetch(PDO::FETCH_ASSOC));