var ultimoAdicionado = null;

window.onload = function(){
    ultimoAdicionado = document.getElementById("amostra_a");
}

function teclaApertada(evt){
    if (evt.keyCode === 13) {
        if (evt.target == ultimoAdicionado){
            var campo = document.createElement("input");
            campo.type = "number";
            campo.className = "form-control";
            campo.name = "amostra_a[]";

            campo.addEventListener("keydown", teclaApertada);

            let entradasA = document.getElementById("entradas_a");
            entradasA.appendChild(campo);

            ultimoAdicionado = campo;

            campo.focus();
        } else {
            ultimoAdicionado.focus();
        }

        evt.preventDefault();
    }
}
