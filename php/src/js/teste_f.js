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

var ultimoAdicionadob = null;

window.onload = function(){
    ultimoAdicionadob = document.getElementById("amostra_b");
}

function teclaApertada(vta){
    if (evt.keyCode === 13) {
        if (evt.target == ultimoAdicionadob){
            var campo = document.createElement("input");
            campo.type = "number";
            campo.className = "form-control";
            campo.name = "amostra_b[]";

            campo.addEventListener("keydown", teclaApertada);

            let entradasB = document.getElementById("entradas_a");
            entradasB.appendChild(campo);

            ultimoAdicionadob = campo;

        } else {
            ultimoAdicionadob.focus();
        }

        evt.preventDefault();
    }
}
