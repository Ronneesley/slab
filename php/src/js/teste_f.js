var ultimoAdicionadoA = null;
var ultimoAdicionadoB = null;

window.onload = function(){
    ultimoAdicionadoA = document.getElementById("amostra_a");
    ultimoAdicionadoB = document.getElementById("amostra_b");
}

function teclaApertadaA(evt){
    if (evt.keyCode === 13) {
        if (evt.target == ultimoAdicionadoA){
            var campo = document.createElement("input");

            if (evt.target.value !== ""){
            campo.type = "number";
            campo.step = "any";
            campo.className = "form-control";
            campo.name = "amostra_a[]";

            campo.addEventListener("keydown", teclaApertadaA);

            let entradasA = document.getElementById("entradas_a");
            entradasA.appendChild(campo);

            ultimoAdicionadoA = campo;

            campo.focus();
        
        }else{
            alert("O campo não pode estar vazio!")
        }        
            }else {
                    ultimoAdicionadoA.focus();
                }
            
                evt.preventDefault();
        
    }
}

function teclaApertadaB(evt){
    if (evt.keyCode === 13) {
        if (evt.target == ultimoAdicionadoB){
            var campo = document.createElement("input");
            
            if (evt.target.value !== ""){
            campo.type = "number";
            campo.step = "any";
            campo.className = "form-control";
            campo.name = "amostra_b[]";

            campo.addEventListener("keydown", teclaApertadaB);

            let entradasB = document.getElementById("entradas_b");
            entradasB.appendChild(campo);

            ultimoAdicionadoB = campo;

            campo.focus();
        }else{
            alert("O campo não pode estar vazio!")
        }
            } else {
                ultimoAdicionadoB.focus();
            }
            evt.preventDefault();
    }
}