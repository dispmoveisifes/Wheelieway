<?php
    //ainda, nao funcional
    require("pdoConnect.php");
    session_start();
    if(isset($_SESSION["email"]) && isset($_POST["senhaAtual"]) && isset($_POST["newPassword"]) && isset($_POST["confirmNewPassword"])){
        $resposta = array();
        $senhaAtual = $_POST["senhaAtual"];
        $newPassword = $_POST["newPassword"];
        $confNewPassword = $_POST["confirmNewPassword"];
        $newToken = password_hash($newPassword, PASSWORD_DEFAULT);
        $email = $_SESSION["email"];
        $consultaToken = $db->prepare("SELECT senha FROM usuario WHERE email = '$email'");
        if($consultaToken->execute()){
            if($consultaToken->rowCount() > 0){
                while($linha = $consultaToken->fetch(PDO::FETCH_ASSOC)){
                    var_dump($linha["senha"]);
                        if(password_verify($senhaAtual, $linha["senha"]) && $newPassword === $confNewPassword){
                            $consultaUpdate = $db->prepare("UPDATE usuario SET senha = '$newToken' WHERE email = '$email'");
                            if($consultaUpdate->execute()){
                                $resposta["sucesso"] = 1;
                                //header('location: http://localhost/pi2023/pusu.php');
                                //die();
                            }
                            else{
                                $resposta["sucesso"] = 0;
                                $resposta["erro"] = "erro: " . $consultaUpdate->error;
                            }
                        }
                        else{
                            $resposta["sucesso"] = 0;
                            $resposta["erro"] = "senhas não conferem";
                        }
                }
            }
            else{
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "usuario nao encontrado";
            }
        }
        

    }
    else{
        $resposta["sucesso"] = 0;
        $resposta["erro"] = "faltam parametros";
    }
    //header("location: http://localhost:8080/pi2023/pusu.php");
    //die();
?>