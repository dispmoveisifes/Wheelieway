estrelas = [...document.getElementsByClassName("estrelaAvaliacao")];
inputs = [...document.getElementsByClassName("estrela")];
/*estrelas.forEach(estrela => {
    estrela.addEventListener('mouseover', (e) => {
        for(let i = 0; i <= parseInt(e.srcElement.id); i++) {
            estrelas[i].classList.remove("fa-regular");
            estrelas[i].classList.add("fa-solid")
        }
    })
});

estrelas.forEach(estrela => {
    estrela.addEventListener('mouseout', (e) => {
        for(let i = 0; i <= parseInt(e.srcElement.id); i++) {
            estrelas[i].classList.remove("fa-solid");
            estrelas[i].classList.add("fa-regular")
        }
    })
});*/

estrelas.forEach(estrela => {
    estrela.addEventListener('click', (e) => {
        for(let i = 0; i < 5; i++) {
            estrelas[i].classList.remove("fa-solid")
            estrelas[i].classList.add("fa-regular")
        }
        for(let i = 0; i <= parseInt(e.srcElement.id); i++) {
           estrelas[i].classList.add("fa-solid")
        }
        for(let i = 0; i < 5; i++) {
            if(i == parseInt(e.srcElement.id)) {
                inputs[i].checked = true;
            }
        }
    })
})