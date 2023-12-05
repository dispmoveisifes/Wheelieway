document.getElementById("selectImg").addEventListener('click', (e) => {
    document.getElementById("imgPerfil").click();
})
document.getElementById("selectImg").nextSibling.nextSibling.addEventListener('click', (e) => {
    document.getElementById("imgPerfil").click();
})

document.getElementById("selectImgAval").addEventListener('click', (e) => {
    document.getElementById("imgAval").click();
})

document.getElementById("botCad").addEventListener('click', async (e) => {
    await carregaEndereco();
    console.log(document.getElementById("latitude").value, document.getElementById("longitude").value);
    document.getElementById("form_estab").submit();
});

document.getElementById("imgPerfil").addEventListener("change", (e) => {
    var input = document.getElementById("imgPerfil");
    var label = document.getElementById("selectImgAval");
    if (input.files.length > 0) {
      // obter o nome do arquivo selecionado
      var nome = input.files[0].name;
      // alterar o texto da label
      label.textContent = "Arquivo selecionado: " + nome;
    } else {
      // restaurar o texto original da label
      label.textContent = "Foto de perfil do estabelecimento";
    }
})

async function carregaEndereco(){
    let dados = await buscarEndereco(endereco = document.getElementById("endereco").value.replace(" ", "%20").concat("%20", document.getElementById("numero").value, "%20", document.getElementById("bairro").value.replace(" ", "%20"), "%20", document.getElementById("cidade").value.replace(" ", "%20"), "%20", document.getElementById("estado").value, "%20", "Brazil"));
    document.getElementById("latitude").value = String(dados["resourceSets"][0]["resources"][0]["geocodePoints"][0]["coordinates"][0]);
    document.getElementById("longitude").value = String(dados["resourceSets"][0]["resources"][0]["geocodePoints"][0]["coordinates"][1]);
}

async function buscarEndereco(endereco){
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

// fetch(`https://dev.virtualearth.net/REST/v1/Locations?query={${endereco}}&maxResults=1&key=Agz-GsinzRU8zLEoIGspfeW14MkrCmOv1RXL5foc3GtKtQWkGHydai2rkhG_ZwQu`, {
//   method: 'GET', // ou 'POST'
//   headers: {
//     'Content-Type': 'application/json',
//     // 'Authorization': 'Bearer seu-token' // se necessário
//   },
// })
// .then(response => response.json()) // converte a resposta em JSON
// .then(function (data){
//     document.getElementById("latitude").value = String(data["resourceSets"][0]["resources"][0]["geocodePoints"][0]["coordinates"][0]);
//     document.getElementById("longitude").value = String(data["resourceSets"][0]["resources"][0]["geocodePoints"][0]["coordinates"][1]);
// })
// .catch((error) => {
//   console.error('Erro:', error);
// });

// const imgFundo = document.getElementById("imgFundo");
// imgFundo.style.width = `${window.innerWidth}px`;
// imgFundo.style.height = `${window.innerHeight}px`;

// document.addEventListener('resize', (e) => {

//     document.getElementsByClassName("fundo")[0].style.width = 
// })