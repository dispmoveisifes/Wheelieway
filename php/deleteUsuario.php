<?php
    //esse arquivo recebe uma senha por um formulario e usa o email da sessao para procurar no banco uma correspondencia e apagar
    require("pdoConnect.php");
    session_start();
    if(isset($_SESSION["email"]) && isset($_POST["senhaAtual"])){    
        $senha = $_POST["senhaAtual"];
        $token = password_hash($senha, PASSWORD_DEFAULT);
        $consulta = $db->prepare("DELETE FROM usuario WHERE email = :email AND senha = :senhaAtual");
        $consulta->bindParam(':email', $_SESSION["email"]);
        $consulta->bindParam(':senhaAtual', $token);
        if($consulta->execute()){
            $resposta["sucesso"] = 1;
            session_destroy();
            header("location: http://localhost/pi2023/");
            die();
        }
        else{
            $resposta["sucesso"] = 0;
            $resposta["erro"] = "erro: " . $consulta->error;
        }
    }
    else{
        $resposta["sucesso"] = 0;
        $resposta["erro"] = "faltam parâmetros";
    }
    header("location: http://localhost/pi2023/pusu.php");
    die();
?>