<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="script/pergunta.js" defer></script>
    <link rel="stylesheet" href="css/pergunta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Wheelieway</title>
</head>
<body>
    <?php
        session_start();
        if($_SESSION["index"] > 4){
            $_SESSION["index"] = 0;
            header("location: http://localhost/pi2023/");
            die();
        }
        if(!(isset($_SESSION["index"]) && isset($_SESSION["perguntas"]))){
            $_SESSION["index"] = 0;
            $_SESSION["perguntas"] = ["Pergunta 1", "Pergunta 2", "Pergunta 3", "Pergunta 4", "Pergunta 5"];
        }
    ?>
    <div class="background">
        <form id="pergunta_form" method="post" action="php/perguntas.php">
            <!--header-->
            <div id="form_header">
                <h1>
                    <?php
                        echo $_SESSION["perguntas"][$_SESSION["index"]];
                    ?>
                </h1>
            </div>
            <!--inputs-->
            <div id="inputs">
                <div class="input-box">
                    <label for="sim">
                        SIM
                        <div class="input-field">
                            <input type="radio" id="sim" name="resposta" value="sim" class="resposta">
                            <label for="sim"><i class="fa-solid fa-check"></i></label>
                        </div>
                    </label>
                </div>

                <div class="input-box">
                    <label for="nao">
                        NÃO
                        <div class="input-field">
                            <input type="radio" id="nao" name="resposta" value="nao" class="resposta">
                            <label for="nao"><i class="fa-solid fa-xmark"></i></label>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" id="login_button">
                <?php
                    if($_SESSION["index"] >= 4) echo "Enviar";
                    else echo "Próximo";
                ?>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
        <img src="img/logos/logoBranco.svg" class="logo">
    </div>
</body>