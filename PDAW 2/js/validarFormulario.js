var contador = 0;
function comprobarClave() {
    let clave1 = document.getElementById("clave1");
    let clave2 = document.getElementById("clave2");

    if (clave1.value == clave2.value) {
        let pPassword = document.getElementById("p-password");
        if (pPassword) {
            pPassword.parentNode.removeChild(pPassword);
        }
        return true;
    } else {
        if (!document.getElementById("p-password")) {
            var p = document.createElement("p");
            p.textContent = "Las contraseñas no coinciden.";
            p.setAttribute("id", "p-password");
            p.style.color = "red";

            var caja = document.getElementsByClassName("input-fields")[0];
            caja.appendChild(p);
        }
        return false;
    }
}

function validarFormulario() {
    let nombre = document.getElementById("nombre").value;
    let apellidos = document.getElementById("apellidos").value;
    let usuario = document.getElementById("usuario").value;
    let email = document.getElementById("email").value;
    let clave1 = document.getElementById("clave1").value;
    let clave2 = document.getElementById("clave2").value;

    if (nombre == "" || apellidos == "" || usuario == "" || email == "" || clave1 == "" || clave2 == "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    if (!comprobarClave()) {
        return false;
    }

    return true;
}


