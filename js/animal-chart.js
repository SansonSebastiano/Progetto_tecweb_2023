const checkbox = document.querySelector('#checkbox-discovered');
const btnNameOrder = document.querySelector('#btn-name-order');
const btnUpOrder = document.querySelector('#btn-up-order');
const btnDownOrder = document.querySelector('#btn-down-order');
  
btnNameOrder.addEventListener('click', () => {   
    if (!localStorage.getItem("btnNameOrderClicked")) {
        if (checkbox.checked) {
            window.location.href = 'animal-chart.php?order=animalorder_up&discovered=1';
        } else {
            window.location.href = 'animal-chart.php?order=animalorder_up&discovered=0';
        }
        localStorage.setItem("btnNameOrderClicked", true);
    } else {
        if (checkbox.checked) {
            window.location.href = 'animal-chart.php?order=animalorder_down&discovered=1';
        } else {
            window.location.href = 'animal-chart.php?order=animalorder_down&discovered=0';
        }
        localStorage.removeItem("btnNameOrderClicked");
    }
});

btnUpOrder.addEventListener('click', () => {
    if (!localStorage.getItem("btnUpOrderClicked")) {
        if (checkbox.checked) {
            window.location.href = 'animal-chart.php?order=uporder&discovered=1';
        } else {
            window.location.href = 'animal-chart.php?order=uporder&discovered=0';
        }
        localStorage.setItem("btnUpOrderClicked", true);
    } else {
        if (checkbox.checked) {
            window.location.href = 'animal-chart.php?order=downorder&discovered=1';
        } else {
            window.location.href = 'animal-chart.php?order=downorder&discovered=0';
        }
        localStorage.removeItem("btnUpOrderClicked");
    }
});

btnDownOrder.addEventListener('click', () => {
    if (!localStorage.getItem("btnDownOrderClicked")) {
    if (checkbox.checked) {
            window.location.href = 'animal-chart.php?order=downorder&discovered=1';
        } else {
            window.location.href = 'animal-chart.php?order=downorder&discovered=0';
        }
    localStorage.setItem("btnDownOrderClicked", true);
    } else {
        if (checkbox.checked) {
            window.location.href = 'animal-chart.php?order=uporder&discovered=1';
        } else {
            window.location.href = 'animal-chart.php?order=uporder&discovered=0';
        }
        localStorage.removeItem("btnDownOrderClicked");
    }
});

checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        localStorage.setItem("myCheckboxState", "checked");
        window.location.href = 'animal-chart.php?order=uporder&discovered=1';
    } else {
        localStorage.removeItem("myCheckboxState");
        window.location.href = 'animal-chart.php?order=uporder&discovered=0';
    }
});

// Check if the checkbox state is stored in local storage
if (localStorage.getItem("myCheckboxState") === "checked") {
  checkbox.checked = true;
}
