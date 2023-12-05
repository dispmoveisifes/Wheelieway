<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/loginRegister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Wheelieway</title>
</head>
<body>
    <!--conteúdo do login-->
    <div id="login_content">
    <?php if(isset($_GET["erro"])):?>
        <div class="error-box">
            <i class="fa-solid fa-triangle-exclamation" style="color: #ffffff;"></i>
            <label><?php echo $_GET["erro"]?></label>
        </div>
    <?php endif ?>
        <form id="login_form" method="post" action="php/loginServer.php">
            <!--header-->
            <div id="form_header">
                <h1>Entrar</h1>
            </div>
            <!--inputs-->
            <div id="inputs">
                <div class="input-box">
                    <label for="email">
                        Email
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" id="email" name="email">
                        </div>
                    </label>
                </div>

                <div class="input-box">
                    <label for="password"> 
                        Senha
                        <div class="input-field">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" id="password" name="password">
                        </div>
                    </label>
                </div>
            </div>

            <!--botão-->
            <button type="submit" id="login_button">
                Entrar
            </button>

            <!--input hidden para saber se o envio foi feito pelo login ou pelo registro-->
            <input type="hidden" name="type" value="login">
        </form>

        <!--logo-->
        <img src="img/logos/logoBranco.svg" class="logo">
    </div>
</body>