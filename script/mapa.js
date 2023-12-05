const menuLateral = document.getElementById("menuLateral");
var ultimoPushpinClicado = null
var icones = {
    1:	"fa-solid fa-utensils",
    2:	"Hoteis",
    3:	"Centros Educativos",
    4:	"Lazer e Esporte",
    5:	"Lojas",
    6:	"Hospitais",
    7:	"Academias",
    8:	"Eventos e Festas",
    11:	"Cafeterias",
    12:	"Bares",
    13:	"Farmácias",
    14:	"Shoppings",
    15: "Museus",
    16:	"Padarias",
    17:	"Cinemas",
    18:	"Supermercados",
    19:	"Academias",
    20:	"Bibliotecas",
    21:	"Outros"
};


document.getElementById("inpPesquisa").addEventListener('keydown', (e) => {
    if (e.key == 'Enter') {
        pesquisaMapa()
    }

})

document.getElementById("setaPerfAbre").addEventListener('click', (e) => {
    document.getElementById("dadosPerfMobile").classList.remove("d-flex");
    document.getElementById("dadosPerfMobile").classList.add("d-none");
    document.getElementById("dadosPerf").classList.remove("d-none");
    document.getElementById("imgPerfilEstabelecimento").classList.remove("d-none");
    document.getElementById("imgPerfilEstabelecimento").classList.remove("d-md-block");
    document.getElementById("inpPesquisa").style.display = "none";
    if (window.innerWidth <= 470) {
        document.getElementById("botFechaPerfilMobile").classList.remove("d-none");
    }
})

document.getElementById("setaPerfFecha").addEventListener('click', (e) => {
    document.getElementById("dadosPerfMobile").classList.add("d-flex");
    document.getElementById("dadosPerfMobile").classList.remove("d-none");
    document.getElementById("dadosPerf").classList.add("d-none");
    document.getElementById("imgPerfilEstabelecimento").classList.add("d-none");
    document.getElementById("imgPerfilEstabelecimento").classList.add("d-md-block");
    document.getElementById("inpPesquisa").style.display = "block";
    if (window.innerWidth <= 470) {
        document.getElementById("botFechaPerfilMobile").classList.add("d-none");
    }
})


/*funcao que calcula o tamanho do mapa com base no tamanho da tela*/
function calculaTamanhoMapa(mapa) {
    const posicaoYMapa = mapa.offsetTop;
    var alturaPagina = window.innerHeight;
    mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
    mapa.style.width = `${document.querySelector("header").clientWidth}px`
}

var map = null;

function carregaPerfil(clicada) {
    document.getElementById("nomeEstabelecimento").textContent = clicada["pushpin"].getTitle();
    console.log(document.getElementById("nomeEstabelecimento").textContent)
    document.getElementById("imgPerfilEstabelecimento").setAttribute('src', clicada["imagem"]);
    document.getElementById("estabIcon").setAttribute("class", icones[clicada["icone"]]);
    if (window.innerWidth < 470) {
        document.getElementById("nomeEstabelecimentoMobile").textContent = clicada["pushpin"].getTitle();
        document.getElementById("imgPerfilEstabelecimentoMobile").setAttribute('src', clicada["imagem"]);
        console.log(document.getElementById("imgPerfilEstabelecimentoMobile").getAttribute("src"))
    }
}

async function carregaEstabelecimento(){
    let resposta = await fetch('http://localhost/pi2023/php/selectEstabMapa.php', {
        method: 'POST',  
        headers: { 'Content-Type': 'application/json' } 
        });
        let estabJson = await resposta.json();
        return estabJson;
}

/*esta funcao carrega o mapa*/
async function loadMapScenario(estabJson) {
    estabJson = await carregaEstabelecimento();
    console.log(estabJson);
    const mapa = document.getElementById("mapa");
    calculaTamanhoMapa(mapa)
    var locIfes = new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478);
    /*cria um objeto de mapa da microsoft e adiciona a div que ira conter o mapa*/
    if (window.innerWidth <= 540) {
        map = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locIfes,
            zoom: 16,
            NavigationBarMode: "minified",
            navigationBarOrientation: "vertical",
            showMapTypeSelector: false,
            showLocateMeButton: true,
        });
    }
    //se a tela for maior que 540px inicializa o mapa com outras configuracoes
    else {
        map = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locIfes,
            zoom: 16,
            NavigationBarMode: "minified",
            navigationBarOrientation: "horizontal"
        });
    }

    //inicializa um objeto que ira armazenar os locais que nos cadastramos
    var locaisProprios = {}

    //carrega o modulo de autosugestao do bing maps
    Microsoft.Maps.loadModule('Microsoft.Maps.AutoSuggest', function () {
        var options = {
            maxResults: 4,
            map: map,
        };
        //inicializa o manager de auto sugestao
        var manager = new Microsoft.Maps.AutosuggestManager(options);
        //este evento faz com que toda vez que o usuario solte um tecla o algoritmo de pesquisa rode novamente
        document.getElementById("inpPesquisa").addEventListener('keyup', (e) => {
            //captura o valor do input
            var pesquisa = document.getElementById("inpPesquisa").value.toLowerCase()
            //fecha o perfil aberto
            document.getElementById("perfilEstabelecimento").style.display = "none";
            document.getElementById("botFechaPerfil").classList.add("d-none")
            //caso nao tenha nada digitado remove as sugestoes
            if (pesquisa.length == 0) {
                document.getElementById("sugestoes").style.display = "none";
                var divSugestoes = document.getElementById("sugestoes").querySelectorAll("div");
                for (let item of divSugestoes) {
                    item.remove();
                }
            }
            //inicializa o array de correspondencias
            var correspondentes = []
            //procura por correspondencias com os nossos locais cadastrados
            for (let item in locaisProprios) {
                if (locaisProprios[item]["nome"].toLowerCase().match(pesquisa)) {
                    correspondentes.push(locaisProprios[item]);
                }
            }
            //caso sobre espaco nas sugestoes (maximo quatro), preenche com sugestoes do bing
            manager.getSuggestions(pesquisa, function (suggestionResult) {
                if (suggestionResult.length > 0) {
                    document.getElementById("sugestoes").style.display = "block";
                    var quatroSugestoes = suggestionResult.slice(0, 4);
                    console.log(suggestionResult)
                    var quantidade = correspondentes.length;
                    for (let i = 0; i < quatroSugestoes.length - quantidade; i++) {
                        let local = {
                            'nome': quatroSugestoes[i].formattedSuggestion,
                            'pushpin': new Microsoft.Maps.Pushpin(quatroSugestoes[i].location, {
                                color: "red",
                                title: quatroSugestoes[i].title
                            })
                        }
                        correspondentes.push(local);
                    }
                    //esvazia o container de sugestoes
                    var containerSugestoes = document.getElementById("sugestoes");
                    var divSugestoes = containerSugestoes.querySelectorAll("div");
                    for (let item of divSugestoes) {
                        item.remove();
                    }
                    //se houver correspondencias, as exibe nas divs e adiciona um evento de clique que abre o perfil referente a div clicada
                    if (correspondentes.length > 0) {
                        for (item of correspondentes) {
                            div = document.createElement("div");
                            div.textContent = item["nome"];
                            div.addEventListener('click', (e) => {
                                let divSugestoes = document.getElementById("sugestoes").querySelectorAll("div");
                                let sugestoes = Array.from(divSugestoes);
                                let clicada = correspondentes[sugestoes.indexOf(e.target)];
                                document.getElementById("sugestoes").style.display = "none";
                                document.getElementById("inpPesquisa").value = "";
                                map.setView({
                                    center: clicada["pushpin"].getLocation(),
                                    zoom: 16
                                });
                                if (clicada["imagem"] != null) {
                                    document.getElementById("botFechaPerfil").classList.remove("d-none")
                                    document.getElementById("perfilEstabelecimento").style.display = "block"
                                    carregaPerfil(clicada)
                                }
                            })
                            containerSugestoes.appendChild(div);
                        }
                    }
                }
            })
        })
    });

    locaisProprios = Array();

    estabJson["estabelecimentos"].forEach((estabelecimento) => {
        let pushpin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(estabelecimento["latitude"], estabelecimento["longitude"]), {
            color: "blue",
            title: estabelecimento["nome"],
        });
        estabelecimento = {
            "nome": estabelecimento["nome"],
            "pushpin": pushpin,
            "imagem": null,
            "icone": estabelecimento["tipo_estabelecimento"],
        }

        locaisProprios.push(estabelecimento);
    })

    //criando os pins do mapa 
    var ifes = new Microsoft.Maps.Pushpin(locIfes, {
        color: "green",
        title: "Ifes Campus Serra",
    });

    var jaymeDosSantosNeves = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.199232504534884, -40.227077110956316), {
        color: "red",
        title: "Hospital Jayme dos Santos Neves",
    });

    var cafeArrumado = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.19826402415827, -40.224856532079116), {
        color: "blue",
        title: "Café Arrumado"
    })
    //fim dos pins

    //adiconando os pins no objeto de locais proprios
    ifes = {
        "nome": "Ifes campus Serra",
        "pushpin": ifes,
        "imagem": "../img/ifesPerfil.jpg"
    };

    hospitalJayme = {
        "nome": "Jayme dos Santos Neves",
        "pushpin": jaymeDosSantosNeves,
        "imagem": "../img/jaymePerfil.jpg"
    };

    cafeArrumado = {
        "nome": "Café Arrumado",
        "pushpin": cafeArrumado,
        "imagem": "../img/cafeArrumadoPerfil.jpg"
    }

    locaisProprios.push(ifes);
    locaisProprios.push(hospitalJayme);
    locaisProprios.push(cafeArrumado);

    //adicionano evento de mapa nos pins
    for (let item in locaisProprios) {
        map.entities.push(locaisProprios[item]["pushpin"]);

        //se o pin for clicado, abre o perfil do estabelecimento, caso o mesmo pin seja clicado novamente fecha o perfil
        Microsoft.Maps.Events.addHandler(locaisProprios[item]["pushpin"], 'click', function (e) {
            var perfilEstabelecimento = document.getElementById("perfilEstabelecimento");
            document.getElementById("sugestoes").style.display = "none";
            if (ultimoPushpinClicado == e.target) {
                perfilEstabelecimento.style.display = perfilEstabelecimento.style.display === "flex" ? "none" : "flex";
                if (document.getElementById("botFechaPerfil").classList.contains("d-none")) {
                    document.getElementById("botFechaPerfil").classList.remove("d-none");
                }
                else {
                    document.getElementById("botFechaPerfil").classList.add("d-none");
                }
            }
            else {
                ultimoPushpinClicado = e.target;
                perfilEstabelecimento.style.display = "flex";
                document.getElementById("botFechaPerfil").classList.remove("d-none");
                perfilEstabelecimento.classList.remove("desaparecer");
                for (let local in locaisProprios) {
                    if (locaisProprios[local]["pushpin"] == e.target) {
                        var itemClicado = locaisProprios[local];
                    }
                }
                carregaPerfil(itemClicado)
            }
        });
    }

    //adiciona um evento que faz os pins sumirem quando o zoom ficar muito pequeno
    Microsoft.Maps.Events.addHandler(map, 'viewchangeend', function (e) {
        if (map.getZoom() < 16) {
            for (let item in locaisProprios) {
                map.entities.pop(locaisProprios[item]["pushpin"]);
            }
        }
        else {
            for (let item in locaisProprios) {
                map.entities.push(locaisProprios[item]["pushpin"]);
            }
        }
    });
}

//funcao que fecha o perfil do estabelecimento
function fechaPerfil() {
    document.getElementById("perfilEstabelecimento").style.display = "none";
    document.getElementById("botFechaPerfil").classList.add("d-none");
    if (document.getElementById("mapa").style.display == "none") {
        document.getElementById("mapa").style.display = "block"
    }
}

//funcao que roda quando o usuario clica enter no input sem escolher uma sugestao
function pesquisaMapa() {

    Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
        var searchManager = new Microsoft.Maps.Search.SearchManager(map);
        var lugar = document.getElementById("inpPesquisa").value;
        var requestOptions = {
            bounds: map.getBounds(),
            where: lugar,
            callback: function (answer, userData) {
                map.setView({ bounds: answer.results[0].bestView });
                map.entities.push(new Microsoft.Maps.Pushpin(answer.results[0].location));
            }
        };
        searchManager.geocode(requestOptions);
    });
}

/*adiciona o evento de resize para a janela, assim o tamanho do mapa sera recalculado toda vez*/
window.addEventListener("resize", (e) => {
    calculaTamanhoMapa(document.getElementById("mapa"));
})
