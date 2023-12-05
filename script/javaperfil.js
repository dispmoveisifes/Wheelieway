let imagemDentro;

function funcao(){
    texto();
    imagem();
}

function abreImg(imge){
    let modal = document.getElementById("myModal");
    let modalImg = document.getElementById("img01");
    modalImg.style.display = "block";
    let seta1 = document.getElementById("seta1");
    let seta2 = document.getElementById("seta2");
    seta1.style.display = "flex";
    seta2.style.display = "flex";
    modal.style.display = "flex";
    modalImg.src = imge.src;
    imagemDentro = imge;
}

function fechaImg() { 
    let modal = document.getElementById("myModal");
    let modalImg = document.getElementById("img01");
    modal.style.display = "none";
    modalImg.src = "";
    modalImg.style.display = "none"
    let selecionado = document.getElementsByClassName("modalSelecionado");
    selecionado[0].classList.remove("modalSelecionado");
}

function mudaImg(x){
    event.stopPropagation();
    
    let modalImg = document.getElementById("img01");
    let listaPai = imagemDentro.parentNode;
    let pos = Array.from(listaPai.children).indexOf(imagemDentro);
    if (!(x == -1 && pos == 0) && !(x == 1 && pos == Array.from(listaPai.children).length-1)) {
        imagemDentro = listaPai.children[pos+x];
        modalImg.src = imagemDentro.src;
    }
}

function texto() {
    let coments = document.getElementsByClassName("comentario");
    for (let i = 0; i < coments.length; i++) {
        let text = coments.item(i);
        if (text.offsetHeight > 96) {
            text.style.cssText = "overflow:hidden; max-height:96px";
            let p = document.createElement('div');
            p.innerText = "Ler mais";
            p.classList.add('escondetexto');
            p.addEventListener('click', ()=> aumentar(text, p));
            text.after(p);
        }
    } 
}

function imagem() {
    let coments = document.getElementsByClassName("imagens");
    for (let i = 0; i < coments.length; i++) {
        let listaImagens = coments[i].childNodes;
        let oculto=0;
        if (listaImagens.length > 11) {
            for (let j = 9; j < listaImagens.length; j+=2){
                listaImagens[j].style.display = "none";
                oculto++;
            }
            let divF = document.createElement('div');
            divF.classList.add("divImgEscura");
            divF.addEventListener('click', ()=> abreImg(listaImagens[9]));
            let imgF = document.createElement('img');
            imgF.classList.add("imgEscura");
            imgF.src = listaImagens[9].src;
            let txtF = document.createElement('div');
            txtF.classList.add("qtdFotos");
            txtF.innerText = "+" + oculto;
            listaImagens[9].style.filter = "brightness(30%)";
            coments[i].after(divF);
            divF.append(imgF);
            divF.append(txtF);
        }
    }
}

function diminuir(text, p) {
    p.remove();
    text.style.cssText = "overflow:hidden; max-height:96px";
    let x = document.createElement('div');
    x.innerText = "Ler mais";
    x.classList.add('escondetexto');
    x.addEventListener('click', ()=> aumentar(text, x));
    text.after(x);
}

function aumentar(text, p) {
    p.remove();
    text.style.cssText = "max-height:none";
    let x = document.createElement('div');
    x.innerText = "Ler menos";
    x.classList.add('escondetexto');
    x.addEventListener('click', ()=> diminuir(text, x));
    text.after(x);
}

function exibirModal(modalName) {
    let setas = document.getElementsByClassName("seta");
    setas[0].style.display = "none";
    setas[1].style.display = "none";
    let modal = document.getElementById("myModal");
    modal.style.display = "flex";
    let alteraSenhaModal = document.getElementById(modalName);
    alteraSenhaModal.classList.add("modalSelecionado");
}

document.getElementById("photos").addEventListener("change", (e) => {
    var input = document.getElementById("photos");
    var div = document.getElementById("photosName");
    if (input.files.length > 0) {
        for(let i = 0; i< input.files.length; i++) {
            const item = document.createElement('label');
            item.classList.add("fitContent")
            item.append(input.files[i].name);
            div.append(item);
        }
      }
})