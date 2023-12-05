<?php 
    //recebe um email e uma senha pelo form e procura por uma correspondencia no banco
    //salva na sessao
    require("pdoConnect.php");
    
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
 
    $senha = $_POST["password"];
    $token = password_hash($senha, PASSWORD_DEFAULT);
    $respota = array();

    $consulta = $db->prepare("SELECT email, nome, senha FROM USUARIO WHERE email = '$email'");
    if($consulta->execute()){
        if($consulta->rowCount() > 0){
            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                var_dump($senha);
                var_dump($linha["senha"]);
                    if(password_verify($senha, $linha["senha"])){
                        echo "teste";
                        $resposta["sucesso"] = 1;
                        session_start();
                         $_SESSION["nome"] = $linha["nome"];
                         $_SESSION["email"] = $linha["email"];;
                        header('location: http://localhost/pi2023/pusu.php');
                        die();
                    }
                    else{
                        $resposta["sucesso"] = 0;
                        $resposta["erro"] = "senhas não conferem";
                        $erro = "Senha incorreta";
                        header("location: http://localhost/pi2023/login.php?erro=$erro");

                        die();
                    }
            }
        }
        else{
            $resposta["sucesso"] = 0;
            $resposta["erro"] = "usuario nao encontrado";
            $erro = "Usuário não encontrado";
            header("location: http://localhost/pi2023/login.php?erro=$erro");
            die();
        }
    }
    else{
        $resposta["sucesso"] = 0;
        $respota["erro"] = $consulta->error;
        $erro = "Erro na conexão";
        header("location: http://localhost/pi2023/login.php?erro=$erro");
        die();
    }

?>