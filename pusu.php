<!DOCTYPE html>
<html lang="en">

<head>
  <title>Perfil usuário</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/perfilb.css">
  <script src="script/javaperfil.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body onload="funcao()">
  <?php 
    include("header.php");
  ?>

  <?php if(!isset($_SESSION["email"])){
    header("location: http://localhost/pi2023/login.php");
    die();
  }?>
  <div id="myModal" class="modal" onclick="fechaImg()">
    <span class="close" onclick="fechaImg()">&times;</span>
    <figure style="display: flex; align-items: center;"></figure>
      <span id="seta1" class="seta" onclick="mudaImg(-1)">&lt;</span>
      <img class="modal-content" onclick="event.stopPropagation()" id="img01">
      <span id="seta2" class="seta" onclick="mudaImg(1)">&gt;</span>
    </figure>

    <div class="container-editaperfil" onclick="event.stopPropagation()">
      <form id="alterarSenha" action="php/alterarSenha.php" method="POST" style="display:none;">
        <div id="form_header">
          <h1>Alterar Senha</h1>
        </div>

        <div id="inputs">
          <div class="input-box">
            <label for="senhaAtual">
              Senha Atual
              <div class="input-field">
                <input type="password" id="senhaAtual" name="senhaAtual">
              </div>
            </label>
          </div>

          <div class="input-box">
            <label for="newPassword"> 
              Senha Nova
              <div class="input-field">
                <input type="password" id="newPassword" name="newPassword">
              </div>
            </label>
          </div>

          <div class="input-box">
            <label for="confirmNewPassword"> 
              Confirmar Senha Nova
              <div class="input-field">
                <input type="password" id="confirmNewPassword" name="confirmNewPassword">
              </div>
            </label>
          </div>
        </div>

        <button type="submit" id="btnModals">
          Alterar Senha
        </button>
      </form>

      <form id="editarPerfil" action="" method="POST" style="display:none;">
        <div id="form_header">
            <h1>Editar Perfil</h1>
        </div>
        <div id="inputs">
          <div class="input-box">
            <label for="novoNome">
              Novo Nome
              <div class="input-field">
                <input type="text" id="novoNome" name="novoNome">
              </div>
            </label>
          </div>
          
          <div class="btnFoto">
              <label for="novaFoto" class="novaFotoLabel">Enviar Nova Foto</label>
              <input type="file" name="novaFoto" id="novaFoto">
          </div>
        </div>

        <button type="submit" id="btnModals">
          Confirmar Alterações
        </button>
      </form>

      <form id="excluirConta" action="php/deleteUsuario.php" method="POST" style="display:none;">
        <div id="form_header">
            <h1>Excluir Perfil</h1>
        </div>
        <div id="inputs">
          <div class="input-box">
            <label for="senhaAtual">
              Senha Atual
              <div class="input-field">
                <input type="password" id="senhaAtual" name="senhaAtual">
              </div>
            </label>
          </div>
        </div>

        <button type="submit" id="btnModals">
          Excluir Conta
        </button>
      </form>
    </div>
  </div>

  <div class="container text-center p-0">    
    <div class="row"> 
      <div class="col-md-5">
        <div class="card p-0 grude">
          <div class="fAzul">

          </div>
          <div class="rCard">
            <div class="nomeContainer">
              <p id="nomeUser" class="h1 text-white"><?php echo ucfirst($_SESSION["nome"]);?></p>
            </div>
            <div>
              <div class="containerFotos">
                <p class="m-1">
                  <img src="img/perfil/pcamigos.jfif" id="fotoPerfil" class="rounded-circle" alt="Avatar">
                </p> 
              </div>
            </div>
          </div>
          <div class="containerBotoes">
            <button class="store-map-button w-50 m-1" onclick="exibirModal('alterarSenha')">ALTERAR SENHA</button>
            <button class="store-map-button w-50 m-1" style="text-align: center;" onclick="exibirModal('excluirConta')">EXCLUIR CONTA</button>
            <button class="store-map-button w-50 m-1" style="text-align: right;" onclick="exibirModal('editarPerfil')">EDITAR PERFIL</button>
          </div>
        </div>
      </div>
      
      <div class="col-lg-5 col-md-7">
        <!--div com avaliações do usuário-->
        <div id="avaliacoes">
          <!--primeira avaliação-->

          <div class="row m-1">
            <!--nome e imagem de quem comentou no canto superior esquerdo da avaliação-->
            <div class="col-sm-12 d-flex align-items-center">
              <img src="img/perfil/pcamigos.jfif" class="rounded-circle" height="50" width="50" alt="Avatar">
              <p class="m-2">Sergio Malandro</p>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-regular fa-star" style="color:var(--color-blue5);"></i>
            </div>
            <div class="col-sm-12">
              <div class="row justify-content-center">
                <div class="imagens">
                  <img src="img/perfilestabelecimento/1006771.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/grelhazeze.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfilestabelecimento/propaganda.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfilestabelecimento/1601677114568.jfif" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/1500500.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/grelhazeze.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfilestabelecimento/propaganda.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfilestabelecimento/1601677114568.jfif" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/5estrela.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/img1.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/img1.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/pcamigos.jfif" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                </div>
              </div>
            </div>
            <!--comentário e espaçamento do texto da avaliação-->
            <div class="col-sm-12">
              <div class="p-1 border-bottom">
                <p class="text-start comentario">Lá vem o Chaves, Chaves, Chaves, Todos atentos olhando pra TV. Lá vem o Chaves, 
                  Chaves, Chaves, Com uma historinha bem gostosa de se ver Aí vem o Chaves, Chaves, Chaves, Todos atentos olhando pra 
                  TV. Aí vem o Chaves, Chaves, Chaves, Com uma historinha bem gostosa de se ver A Chiquinha é uma gracinha, ninguém 
                  agüenta quando vai chorar E Seu Madruga, sempre muito calado, Não abre a boca só pra não brigar O Professor Girafales 
                  e a Dona Florinda, Se gostam tanto mas casório, nada ainda E tem o Quico com a bochecha toda inchada, E é claro o Chaves, o rei
                  da palhaçada E é claro o Chaves, o rei da palhaçada Lá vem o Chaves, Chaves, Chaves, Tô chegando! Lá vem o Chaves, Chaves, Chaves</p>
              </div>
            </div>
          </div>

          <div class="row m-1">
            <!--nome e imagem de quem comentou no canto superior esquerdo da avaliação-->
            <div class="col-sm-12 d-flex align-items-center">
              <img src="img/perfil/pcamigos.jfif" class="rounded-circle" height="50" width="50" alt="Avatar">
              <p class="m-2">Sergio Malandro</p>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-regular fa-star" style="color:var(--color-blue5);"></i>
            </div>
            <div class="col-sm-12">
              <div class="row justify-content-center">
                <div class="imagens">
                  <img src="img/perfilestabelecimento/1006771.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/grelhazeze.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/img1.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/img1.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/pcamigos.jfif" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                </div>
              </div>
            </div>
            <!--comentário e espaçamento do texto da avaliação-->
            <div class="col-sm-12">
              <div class="p-1 border-bottom">
                <p class="text-start comentario">O Severino Boteco Porreta é um bar com Pintado decoração agradável, atendimento Tucunaré
                  eficiente e música ao vivo. O cardápio oferece variedade de Jatuarana pratos a preços razoáveis.
                  A organização do Tilápia espaço pode ser confusa e o Traíra tempo de espera pode ser longo em
                  momentos de maior movimento. Recomendado para os amantes da culinária, mas esteja preparado para
                  possível aglomeração e tempo de espera.</p>
              </div>
            </div>
          </div>

          <div class="row m-1">
            <!--nome e imagem de quem comentou no canto superior esquerdo da avaliação-->
            <div class="col-sm-12 d-flex align-items-center">
              <img src="img/perfil/pcamigos.jfif" class="rounded-circle" height="50" width="50" alt="Avatar">
              <p class="m-2">Sergio Malandro</p>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-regular fa-star" style="color:var(--color-blue5);"></i>
            </div>
            <div class="col-sm-12">
              <div class="row justify-content-center">
                <div class="imagens">
                  <img src="img/perfilestabelecimento/1006771.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/grelhazeze.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfilestabelecimento/propaganda.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfilestabelecimento/1601677114568.jfif" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/grelhazeze.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/img1.png" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/img1.jpg" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                  <img src="img/perfil/pcamigos.jfif" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                </div>
              </div>
            </div>
            <!--comentário e espaçamento do texto da avaliação-->
            <div class="col-sm-12">
              <div class="p-1 border-bottom">
                <p class="text-start comentario">O Severino Boteco Porreta é um bar com Pintado decoração agradável, atendimento Tucunaré
                  eficiente e música ao vivo. O cardápio oferece variedade de Jatuarana pratos a preços razoáveis.
                  A organização do Tilápia espaço pode ser confusa e o Traíra tempo de.</p>
              </div>
            </div>
          </div>

          <div class="row m-1">
            <!--nome e imagem de quem comentou no canto superior esquerdo da avaliação-->
            <div class="col-sm-12 d-flex align-items-center">
              <img src="img/perfil/pcamigos.jfif" class="rounded-circle" height="50" width="50" alt="Avatar">
              <p class="m-2">Sergio Malandro</p>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-regular fa-star" style="color:var(--color-blue5);"></i>
            </div>
            <div class="col-sm-12">
              <div class="row justify-content-center">
                <div class="imagens">
                  <img src="img/perfil/pcamigos.jfif" onclick="abreImg(this)" width="50px" height="50px" class="imagemAbre rounded">
                </div>
              </div>
            </div>
            <!--comentário e espaçamento do texto da avaliação-->
            <div class="col-sm-12">
              <div class="p-1 border-bottom">
                <p class="text-start mb-0 comentario">O Severino Boteco Porreta é um bar com Pintado decoração agradável, atendimento Tucunaré
                  eficiente e música ao vivo. O cardápio oferece variedade de Jatuarana pratos a preços razoáveis.
                  A organização do Tilápia espaço pode ser confusa e o Traíra tempo de espera pode ser longo em
                  momentos de maior movimento. Recomendado para os amantes da culinária, mas esteja preparado para
                  possível aglomeração e tempo de espera.</p>
              </div>
            </div>
          </div>

          <div class="row m-1">
            <!--nome e imagem de quem comentou no canto superior esquerdo da avaliação-->
            <div class="col-sm-12 d-flex align-items-center">
              <img src="img/perfil/pcamigos.jfif" class="rounded-circle" height="50" width="50" alt="Avatar">
              <p class="m-2">Sergio Malandro</p>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-solid fa-star" style="color:var(--color-blue5);"></i>
              <i class="fa-regular fa-star" style="color:var(--color-blue5);"></i>
            </div>
            <div class="col-sm-12">
              <div class="row justify-content-center">
                <div class="imagens">
                </div>
              </div>
            </div>
            <!--comentário e espaçamento do texto da avaliação-->
            <div class="col-sm-12">
              <div class="p-1 border-bottom">
                <p class="text-start comentario">om bar! A garrafa desce redonda que nus..! Sempre que passo em Uberaba dou uma visita pra tomar
                  uma dose sjakdhasjkdashdajkshdo wdjka whdjawhd jwahdjhad jhsjk hhas dhsajdkhsajhd kjashdawyhd uawhy udauiwyh uwyd uyuwy duiy uiwy y
                dhasjhd ahd adk jashdjk haskjdhkj hdsjkadiwo uqoeiu ue qwiou</p>
              </div>
            </div>
          </div>

        </div>

      </div>    
          
    </div>
  </div>

  <?php 
  include("footer.php");
  ?>
</body>

</html>