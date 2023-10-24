var ultimoAdicionadoA = null;
var ultimoAdicionadoB = null;

window.onload = function(){
    ultimoAdicionadoA = document.getElementById("amostra_a");
    ultimoAdicionadoB = document.getElementById("amostra_b");
}

function teclaApertadaA(evt){
    if (evt.keyCode === 13) {
        if (evt.target == ultimoAdicionadoA){
            if (ultimoAdicionadoA.value.trim() !== "") {
                var campo = document.createElement("input");
                campo.type = "number";
                campo.step = "any"; 
                campo.className = "form-control";
                campo.name = "amostra_a[]";
                campo.required = true;

                campo.addEventListener("keydown", teclaApertadaA);

                let entradasA = document.getElementById("entradas_a");
                entradasA.appendChild(campo);

                ultimoAdicionadoA = campo;

                campo.focus();
            } else {
                alert("Campo Amostra A não pode estar vazio!");
            }
        }
        evt.preventDefault();
    }
}

function teclaApertadaB(evt){
    if (evt.keyCode === 13) {
        if (evt.target == ultimoAdicionadoB){
            if (ultimoAdicionadoB.value.trim() !== "") {
                var campo = document.createElement("input");
                campo.type = "number";
                campo.step = "any"; 
                campo.className = "form-control";
                campo.name = "amostra_b[]";
                campo.required = true;

                campo.addEventListener("keydown", teclaApertadaB);

                let entradasB = document.getElementById("entradas_b");
                entradasB.appendChild(campo);

                ultimoAdicionadoB = campo;

                campo.focus();
            } else {
                alert("Campo Amostra B não pode estar vazio!");
            }
        }
        evt.preventDefault();
    }
}
