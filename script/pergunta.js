const checkBoxCategory = [...document.getElementsByClassName("resposta")];

for (let i = 0; i < checkBoxCategory.length; i++) {
  checkBoxCategory[i].addEventListener('change', () => {
    for (let j = 0; j < checkBoxCategory.length; j++) {
      if (checkBoxCategory[j] !== checkBoxCategory[i]) {
        checkBoxCategory[j].nextElementSibling.children[0].classList.remove("category-checked");
        checkBoxCategory[j].nextElementSibling.children[0].classList.remove("category-checked-no");
      }
    }

    if (checkBoxCategory[i].checked) {
        if(checkBoxCategory[i].id == "sim") {
            checkBoxCategory[i].nextElementSibling.children[0].classList.add("category-checked");
        } else {
            checkBoxCategory[i].nextElementSibling.children[0].classList.add("category-checked-no");
        }
    } else {
        checkBoxCategory[i].nextElementSibling.children[0].classList.remove("category-checked");
        checkBoxCategory[i].nextElementSibling.children[0].classList.remove("category-checked-no");
    }
  });
}