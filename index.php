<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="css/index.css" rel="stylesheet">
  <script src="script/index.js" defer></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>WheelieWay</title>
</head>
<body onload="carregaEstabelecimento()">
  <!--chamando o header-->
  <?php 
    include("header.php");
  ?>

  <!--banner que redireciona para página de cadastro de estabelecimento-->
  <div class="banner-box">
    <img src="img/index/CadastreEstabelecimento.png">
    <a href="cadastro.html">CADASTRAR</a>
  </div>

  <!--container de todos elementos referente a busca de estabelecimentos, organizado em grid 2x2
  Barra de Pesquisa; Filtros; Cards de Estabelecimentos
  -->
  <div id="search_content">
    <!--container que armazena a barra de busca para os estabelecimentos-->
    <div id="searchBar_content">
      <input type="search" spellcheck="false">
      <i class="fa-solid fa-magnifying-glass" id="searchButton"></i>
    </div>

    <!--container que armazena todos os tipos de filtros-->
    <div class="filter_content">
      <form action="" method="POST" class="filter_content">
        <!--container que armazena filtros por categoria, feito com inputs type checkbox-->
        <div class="category-filter">
          <label class="category-title">CATEGORIAS</label>
          <ul id="ul-category">
            <li><i class="fa-solid fa-utensils"></i><label for="restaurante">RESTAURANTES</label><input class="checkbox-category" type="radio" name="categoryFilters" id="restaurante"></li>
            <li><i class="fa-solid fa-bread-slice"></i><label for="padaria">PADARIAS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="padaria"></li>
            <li><i class="fa-solid fa-mug-hot"></i><label for="cafeteria">CAFETERIAS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="cafeteria"></li>
            <li><i class="fa-solid fa-wine-glass"></i><label for="bar">BARES</label><input class="checkbox-category" type="radio" name="categoryFilters" id="bar"></li>
            <li><i class="fa-solid fa-bed"></i><label for="hotel">HOTÉIS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="hotel"></li>
            <li><i class="fa-solid fa-film"></i><label for="cinema">CINEMAS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="cinema"></li>
            <li><i class="fa-solid fa-bag-shopping"></i><label for="shopping">SHOPPINGS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="shopping"></li>
            <li><i class="fa-solid fa-cart-shopping"></i><label for="supermercado">SUPERMERCADOS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="supermercado"></li>
            <li><i class="fa-solid fa-shirt"></i><label for="lojaderoupa">LOJAS DE ROUPA</label><input class="checkbox-category" type="radio" name="categoryFilters" id="lojaderoupa"></li>
            <li><i class="fa-solid fa-stethoscope"></i><label for="hospital">HOSPITAIS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="hospital"></li>
            <li><i class="fa-solid fa-prescription-bottle-medical"></i><label for="farmácias">FARMÁCIAS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="farmácias"></li>
            <li><i class="fa-solid fa-dumbbell"></i><label for="academia">ACADEMIAS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="academia"></li>
            <li><i class="fa-solid fa-graduation-cap"></i><label for="escola">ESCOLAS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="escola"></li>
            <li><i class="fa-solid fa-book"></i><label for="biblioteca">BIBLIOTECAS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="biblioteca"></li>
            <li><i class="fa-solid fa-landmark"></i><label for="museus">MUSEUS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="museus"></li>
            <li><i class="fa-solid fa-ellipsis"></i><label for="outros">OUTROS</label><input class="checkbox-category" type="radio" name="categoryFilters" id="outros"></li>
          </ul>
        </div>
        <!--divisoria que conecta os diferentes filtros-->
        <div class="connect-lines">
          <span class="connect-line"></span>
          <span class="connect-line"></span>
        </div>
        <!--container que armazena o filtro por distancia, em km feito com input type number-->
        <div class="distance-filter">
          <label class="distance-title">DISTÂNCIA</label>
          <div class="input-box">
            <label>ATÉ</label>
            <input type="number">
            <label>KILOMETROS</label>
          </div>
        </div>
        <!--divisoria que conecta os diferentes filtros-->
        <div class="connect-lines">
          <span class="connect-line"></span>
          <span class="connect-line"></span>
        </div>
        <!--container que armazena os filtros por notas do estabelecimento, dimensionado em estrelas e feito com inputs type radio-->
        <div class="rating-filter">
          <label class="rating-title">NOTA</label>
          <ul>
            <li>
              <input type="radio" id="1star" name="starRadio">
              <label for="1star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                1+
              </label>
            </li>
            <li>
              <input type="radio" id="2star" name="starRadio">
              <label for="2star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                2+
              </label>
            </li>
            <li>
              <input type="radio" id="3star" name="starRadio">
              <label for="3star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                3+
              </label>
            </li>
            <li>
              <input type="radio" id="4star" name="starRadio">
              <label for="4star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
                4+
              </label>
            </li>
            <li>
              <input type="radio" id="5star" name="starRadio">
              <label for="5star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                5+
              </label>
            </li>
          </ul>
        </div>
        <!--divisoria que conecta os diferentes filtros-->
        <div class="connect-lines">
          <span class="connect-line"></span>
          <span class="connect-line"></span>
        </div>
        <!--container que armazena os filtros por selos do estabalecimento, bronze prata e ouro feito com inputs type radio-->
        <div class="seal-filter">
          <label class="seal-title">SELO</label>
          <div class="seals">
            <input type="radio" id="goldSeal" name="sealFilter">
            <label for="goldSeal">
              <img src="img/selos/seloOuro.svg">
            </label>
            <input type="radio" id="silverSeal" name="sealFilter">
            <label for="silverSeal">
              <img src="img/selos/seloPrata.svg">
            </label>
            <input type="radio" id="bronzeSeal" name="sealFilter">
            <label for="bronzeSeal">
              <img src="img/selos/seloBronze.svg">
            </label>
          </div>
        </div>
        <!--divisoria que conecta os diferentes filtros-->
        <div class="connect-lines">
          <span class="connect-line"></span>
          <span class="connect-line"></span>
        </div>
        <!--botão usado para desmarcar todos os filtros utilizados-->
        <button class="btn-filters" type="submit">APLICAR FILTROS</button>
        <!--divisoria que conecta os diferentes filtros-->
        <div class="connect-lines">
          <span class="connect-line"></span>
          <span class="connect-line"></span>
        </div>
        <button class="btn-filters" type="submit">LIMPAR FILTROS</button>
      </form>
    </div>

    <!--container que armazena todos os cards de estabelecimentos-->
    <div id="stores_content">
    </div>
  </div>

  <!--chamando o footer-->
  <?php 
  include("footer.php");
  ?>
</body>
</html>