<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa</title>

  <!--importando style da página-->
  <link rel="stylesheet" type="text/css" href="css/mapa.css">

  <!--importando style do icones do bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <!--importando style do fontawesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--importando script da página-->
  <!-- <script src="script/mapa.js" defer></script> -->

  <!--importando script dos mapas do bing-->
  <script type='text/javascript'
    src='https://www.bing.com/api/maps/mapcontrol?callback=loadMapScenario&key=Agz-GsinzRU8zLEoIGspfeW14MkrCmOv1RXL5foc3GtKtQWkGHydai2rkhG_ZwQu&libs=Microsoft.Maps.Search'></script>

  <!--importando style do bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!--importando script do bootstrap-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"
    defer></script> 

  <script src="script/mapa.js" defer></script>
</head>

<body onload="carregaEstabelecimento()">
  <?php 
  include("header.php");
  ?>

  <!--section onde o mapa e o menu de pesquisa lateral ficara posicionado-->
  <section id="containerMapa">
    <!--container do menu lateral-->
    <div id="menuLateral" class="menuLateralAcionado container-fluid">
      <!--container onde fica os itens do menu referentes a pesquisa-->
      <div id="containerPesquisa">
        <input type="text" id="inpPesquisa" name="pesquisa" placeholder="Pesquisa">
        <i class="fa-solid fa-rectangle-xmark d-none"
          style="color: #ff0000; font-size: 36px; margin-left: 10px; cursor: pointer;" id="botFechaPerfil"
          onclick="fechaPerfil()"></i>
      </div>
      <div id="sugestoes"></div>
      <!--container onde a seta que minimiza o menu esta-->
    </div>

    <div id="perfilEstabelecimento" style="display: none; " class="card bg-light perfil-estabelecimento">
      <div class="card-body d-flex d-md-none" id="dadosPerfMobile">
        <div class="row justify-content-center text-center align-items-center" id="abrePerfil">
          <i class="fa-solid fa-chevron-up col-12" style="font-size: 24px;" id="setaPerfAbre"></i>
          <p id="nomeEstabelecimentoMobile" class="card-title d-md-none col-12"
            style="text-align: center; font-size: 24px;"></p>
          <p class="col-6" style="color:#00427F; font-size: 18px;">Selo: <span style="color: goldenrod">Ouro</span></p>
          <p class="col-6" style="color:#00427F; font-size: 18px;">Nota: <span style="color: goldenrod">5</span></p>
          <img src="" alt="" class="img-fluid card-img img-perfil-estabelecimento" id="imgPerfilEstabelecimentoMobile">
        </div>
      </div>

      <img src="" alt="" class="img-fluid card-img img-perfil-estabelecimento d-none d-md-block"
        id="imgPerfilEstabelecimento">
      <i class="fa-solid fa-rectangle-xmark d-none card-img-overlay"
        style="color: #ff0000; font-size: 36px; cursor: pointer;" id="botFechaPerfilMobile" onclick="fechaPerfil()"></i>
      <div class="card-body d-none d-md-block" id="dadosPerf">
        <div class="row justify-content-center align-items-center">
          <i class="fa-solid fa-chevron-up text-center mb-3 d-md-none"
            style="font-size: 24px; transform: rotate(180deg);" id="setaPerfFecha"></i>
        </div>
        <div class="d-flex flex-direction-column justify-content-between">
          <p id="nomeEstabelecimento" class="card-title" style="text-align: center; font-size: 24px;"></p>
          <i class="fa-solid fa-graduation-cap" id="estabIcon" style="font-size: 42px; color: var(--color-blue5);"></i>
        </div>
        <div class="row align-items-start justify-content-start">
          <label class="col-12">7.4<i class="fa-solid fa-star"></i> - Bom (70)</label>
          <div class="d-flex justify-content-between align-items-end">
            <img src="img//selos/seloOuro.svg" alt="" class="img-fluid col-6 mt-0" style="width: 50px; height: 50px;">
            <a href="perfilestabelecimento.html" class="card-link col-6 justify-self-end botao">Ver Mais</a>
          </div>
        </div>
      </div>
    </div>


    <!--div onde o mapa sera renderizado-->
    <div id="mapa"></div>
    <!--Fim da section-->
  </section>




</body>

</html>