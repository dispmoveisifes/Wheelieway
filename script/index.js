const checkBoxCategory = [...document.getElementsByClassName("checkbox-category")];

for (let i = 0; i < checkBoxCategory.length; i++) {
  checkBoxCategory[i].addEventListener('change', () => {
    for (let j = 0; j < checkBoxCategory.length; j++) {
      if (checkBoxCategory[j] !== checkBoxCategory[i]) {
        checkBoxCategory[j].parentElement.children[0].classList.remove("category-checked");
      }
    }

    if (checkBoxCategory[i].checked) {
      checkBoxCategory[i].parentElement.children[0].classList.add("category-checked");
    } else {
      checkBoxCategory[i].parentElement.children[0].classList.remove("category-checked");
    }
  });
}

function geraCards(estabJson){
    let storeContent = document.getElementById("stores_content");
    let estabelecimentos = estabJson["estabelecimentos"];
    estabelecimentos.forEach((estabelecimento) => {
        divStoreCard = document.createElement("div")
        divStoreCard.classList.add("store-card");
        divStoreCard.innerHTML = `<img id="${estabelecimento["id"]}" src="${estabelecimento["foto_estabelecimento"]}" class="store-photo">
        <!--container com as informações gerais do estabelecimento-->
        <div class="store-infos">
          <!--categoria do estabelecimento-->
          <label class="store-category">${estabelecimento["tipo_estabelecimento"]}</label>
          <!--nome do estabelecimento-->
          <label class="store-name">${estabelecimento["nome_estabelecimento"]}</label>
          <!--nota do estabelecimento-->
          <label class="store-rating">7.4<i class="fa-solid fa-star"></i> - Bom (70 Avaliações)</label>
          <!--selo do estabelecimento-->
          <img src="img/selos/seloOuro.svg" class="store-seal">
        </div>
        <!--container com as informações referentes a endereço do estabelecimento-->
        <div class="location-infos">
          <!--endereço em extenso do estabelecimento-->
          <label class="store-location">${estabelecimento["tipo_logradouro"]}  ${estabelecimento["logradouro"]}, ${estabelecimento["cidade"]}<br>${Math.round(estabelecimento["distancia"]/1000)}km de distância</label>
          <!--botão para redirecionar o usuario ao mapa, na localização do estabelecimento-->
          <button class="store-map-button">VER NO MAPA</button>
        </div>`
        document.getElementById("stores_content").append(divStoreCard);
      
      document.getElementById(estabelecimento["id"]).addEventListener('click', (e) => {
        window.open(`http://localhost/pi2023/pest.php?id=${estabelecimento["id"]}&tipo_estabelecimento=${estabelecimento["tipo_estabelecimento"]}&nome_estabelecimento=${estabelecimento["nome_estabelecimento"]}&tipo_logradouro=${estabelecimento["tipo_logradouro"]}&logradouro=${estabelecimento["logradouro"]}$cidade=${estabelecimento["cidade"]}`)
      })
    })
}

async function carregaEstabelecimento() {
        let posicao = await new Promise((resolve, reject) => {
            navigator.geolocation.getCurrentPosition(resolve, reject);
        });
        let dados = {"userLatitude": posicao["coords"]["latitude"], "userLongitude": posicao["coords"]["latitude"]};
        let json = JSON.stringify(dados);

        let resposta = await fetch('http://localhost/pi2023/php/selectEstabelecimento.php', {
        method: 'POST', 
        body: json, 
        headers: { 'Content-Type': 'application/json' } 
        });
        let estabJson = await resposta.json();
        geraCards(estabJson);

  }
  

async function buscarEstabelecimentos(){
    let resposta = await fetch(`https://dev.virtualearth.net/REST/v1/Locations?query={${endereco}}&maxResults=1&key=Agz-GsinzRU8zLEoIGspfeW14MkrCmOv1RXL5foc3GtKtQWkGHydai2rkhG_ZwQu`, {
        method: 'GET', // ou 'POST'
        headers: {
          'Content-Type': 'application/json',
          // 'Authorization': 'Bearer seu-token' // se necessário
        },
      });
    let dados = await resposta.json();
    return dados;    
}
