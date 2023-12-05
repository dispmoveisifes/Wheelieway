dados = null

fetch('https://dev.virtualearth.net/REST/v1/Locations?query={Av.%20dos%20Sabias%20330%20Morada%20de%20Laranjeiras%20Serra%20Espirito%20Santo%20Brazil}&maxResults=1&key=Agz-GsinzRU8zLEoIGspfeW14MkrCmOv1RXL5foc3GtKtQWkGHydai2rkhG_ZwQu', {
  method: 'GET', // ou 'POST'
  headers: {
    'Content-Type': 'application/json',
    // 'Authorization': 'Bearer seu-token' // se necessário
  },
})
.then(response => response.json()) // converte a resposta em JSON
.then(data => console.log(data["resourceSets"][0]["resources"][0]["geocodePoints"][0]["coordinates"])) // imprime os dados no console
.catch((error) => {
  console.error('Erro:', error);
});
