var ultimoAdicionado = null;

window.onload = function () {
    ultimoAdicionado = document.getElementById("amostra_a");
}

function teclaApertada(evt) {
    if (evt.keyCode === 13) {
        var campo = document.createElement("input");
        campo.type = "number";
        campo.className = "form-control";

        if (evt.target.name === "amostra_a[]") {
            campo.name = "amostra_a[]";
            let entradasA = document.getElementById("entradas_a");
            entradasA.appendChild(campo);
        } else {
            campo.name = "amostra_b[]";
            let entradasB = document.getElementById("entradas_b");
            entradasB.appendChild(campo);
            
        }

        campo.addEventListener("keydown", teclaApertada);
        ultimoAdicionado = campo;
        campo.focus();
        evt.preventDefault();
    }
}