<?php
    session_start();
    if(isset($_SESSION["email"])){
        if(isset($_POST["resposta"])){
            $_SESSION["index"] += 1;
            $_SESSION["respostas"] = array();
            array_push($_SESSION["respostas"], $_POST["resposta"]);
            header("location: http://localhost/pi2023/pergunta.php");
            die();
        }
    }
    else{
        header("location: http://localhost/pi2023/login.php");
        die();
    }
?>