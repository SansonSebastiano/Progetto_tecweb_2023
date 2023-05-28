const checkbox = document.querySelector('#checkbox-discovered');
const btnNameOrder = document.querySelector('#btn-name-order');
const btnUpOrder = document.querySelector('#btn-up-order');
const btnDownOrder = document.querySelector('#btn-down-order');
  
btnNameOrder.addEventListener('click', () => {
    if (checkbox.checked) {
        window.location.href = 'animal-chart.php?order=animalorder&discovered=1';
    } else {
        window.location.href = 'animal-chart.php?order=animalorder&discovered=0';
    }
});

btnUpOrder.addEventListener('click', () => {
    if (checkbox.checked) {
        window.location.href = 'animal-chart.php?order=uporder&discovered=1';
    } else {
        window.location.href = 'animal-chart.php?order=uporder&discovered=0';
    }
});

btnDownOrder.addEventListener('click', () => {
    if (checkbox.checked) {
        window.location.href = 'animal-chart.php?order=downorder&discovered=1';
    } else {
        window.location.href = 'animal-chart.php?order=downorder&discovered=0';
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
