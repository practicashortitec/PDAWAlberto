document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('input').addEventListener('change', () => {
        if (!document.body.classList.contains('dark')) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    });
});


console.log("Función - OK");

document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('input');
    if (input) {
        input.addEventListener('change', toggleDarkMode);
    } else {
        console.error("No se encontró ningún elemento con el ID 'input'");
    }
});



// Función para activar el modo oscuro
function enableDarkMode() {
    document.body.classList.add('dark');
    localStorage.setItem('darkMode', 'enabled');
}

// Función para desactivar el modo oscuro
function disableDarkMode() {
    document.body.classList.remove('dark');
    localStorage.setItem('darkMode', null);
}

// Función para alternar el modo oscuro
function toggleDarkMode() {
    if (localStorage.getItem('darkMode') === 'enabled') {
        disableDarkMode();
    } else {
        enableDarkMode();
    }
}

// Verificar el estado del modo oscuro al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('input');
    if (localStorage.getItem('darkMode') === 'enabled') {
        enableDarkMode();
        input.checked = true;
    }

    // Escuchar el evento 'change' del interruptor
    input.addEventListener('change', toggleDarkMode);
});