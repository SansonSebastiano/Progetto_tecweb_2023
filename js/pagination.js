const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("article-grid-div");
const listItems = paginatedList.querySelectorAll("li");
const nextButton = document.getElementById("next-button");
const prevButton = document.getElementById("prev-button");
const pageNumberTitle = document.getElementById("page-number");

const paginationLimit = 10;
const pageCount = Math.ceil(listItems.length / paginationLimit);
let currentPage;

// Funzione per aggiungere una nuova pagina
const appendPageNumber = (index) => {
    const pageNumber = document.createElement("button");
    pageNumber.className = "pagination-number";
    pageNumber.innerHTML = index;
    
    pageNumber.setAttribute("page-index", index);
    pageNumber.setAttribute("aria-label", "Page " + index);
    paginationNumbers.appendChild(pageNumber);

  };

// Funzione per ottenere i numeri di pagina
const getPaginationNumbers = () => {
    for (let i = 1; i <= pageCount; i++) {
        appendPageNumber(i);
    }
};

//Invocato quando la pagina è caricata
window.addEventListener("load", () => {
    getPaginationNumbers();
    // La pagina caricata è la prima
    setCurrentPage(1);

    // Il bottone precedente fa visualizzare la pagina precedente
    prevButton.addEventListener("click", () => {
        setCurrentPage(currentPage - 1);
    });
    
    // Il bottone successivo fa visualizzare la pagina successiva
    nextButton.addEventListener("click", () => {
        setCurrentPage(currentPage + 1);
    });
    

    document.querySelectorAll(".pagination-number").forEach((button) => {
        // Ogni bottone ha un attributo page-index che indica il numero di pagina
        const pageIndex = Number(button.getAttribute("page-index"));
        if (pageIndex) {
            button.addEventListener("click", () => {
                // Quando viene cliccato un bottone, viene visualizzata la pagina corrispondente
                setCurrentPage(pageIndex);
            });
        }
    });
});

// Funzione per cambiare pagina (pageNum è il numero di pagina)
const setCurrentPage = (pageNum) => {
    currentPage = pageNum;

    pageNumberTitle.innerHTML = pageNum;

    handleActivePageNumber();
    handlePageButtonsStatus();

    const prevRange = (pageNum - 1) * paginationLimit;
    const currRange = pageNum * paginationLimit;

    // Mostra gli articoli della pagina corrente, nasconde tutti gli altri
    listItems.forEach((item, index) => {
        item.classList.add("hidden");
        if (index >= prevRange && index < currRange) {
            item.classList.remove("hidden");
        }
    });
};

// Evidenzia il bottone della pagina corrente
const handleActivePageNumber = () => {
    document.querySelectorAll(".pagination-number").forEach((button) => {
    button.classList.remove("active");

    const pageIndex = Number(button.getAttribute("page-index"));
    if (pageIndex == currentPage) {
        button.classList.add("active");
    }
  });
};

// Disabilita un bottone
const disableButton = (button) => {
    button.classList.add("disabled");
    button.setAttribute("disabled", true);
};

// Abilita un bottone
const enableButton = (button) => {
    button.classList.remove("disabled");
    button.removeAttribute("disabled");
};

//Gestisce i bottoni prev e next, li abilita o disabilita in base alla pagina corrente
const handlePageButtonsStatus = () => {
    // Se sono sulla prima pagina, disabilito il bottone pagina precedente
    if (currentPage === 1) {
        disableButton(prevButton);
    } else {
        enableButton(prevButton);
    }

    // Se sono sull'ultima pagina, disabilito il bottone pagina successiva
    if (pageCount === currentPage) {
        disableButton(nextButton);
    } else {
        enableButton(nextButton);
    }
};
  