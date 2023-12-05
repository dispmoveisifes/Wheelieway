<link rel="stylesheet" href="css/header.css">
<script src="script/header.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- inicia a sessao -->
<?php session_start(); ?> 

<header>
    <!--conteúdo do header-->
    <div id="header_content">
        <!--nome e logo-->
        <div id="header_name">
            <a href="index.php" class="logo">
                <img src="img/logos/logo.svg">
                <h1>Wheelieway</h1>
            </a>
            <!--botão do menu mobile-->
            <a href="javascript:void(0);" class="mobile-menu" onclick="mobileMenu()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div style="color: black;">
        </div>
        <!--opções-->
        <div id="header_options">
            <a href="mapa.php" class="header-link">Mapa</a>
            <!-- checa se não existe uma sessão ativa-->
            <?php if(!(isset($_SESSION["nome"]))): ?>
                <!-- carrega header com opcoes de login e sign up -->
                <a href="registrar.html" class="header-btnRegister">CRIAR CONTA</a>
                <a href="registrar.html" class="header-link-mobile">CRIAR CONTA</a><!--mobile-->
                <a href="login.php" class="header-btnLogin">ENTRAR</a>
                <a href="login.php" class="header-link-mobile">ENTRAR</a><!--mobile-->
            <?php else: ?>
                <!-- carrega o nome do usuario e um icone que linka ao perfil -->
                <label style="color: var(--color-blue5); font-weight:bold;" for="userIcon"><?php echo ucfirst($_SESSION["nome"]);?></label>
                <a href="perfilusuario.php" class="header-link-mobile">CONTA</a><!--mobile-->
                <a id="userIcon" href="pusu.php" class="header-iconLink">
                    <i class="fa-solid fa-address-card"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>