var DadoAntigoA = null; // Variável para rastrear o último campo de entrada
var GuardaA = "amostra_a[]"; // variavel com id

function createInputA() {
    var NovoDadoA = document.createElement("input");
    NovoDadoA.type = "number";
    document.body.appendChild(NovoDadoA);
    NovoDadoA.focus();
    DadoAntigoA = NovoDadoA;

    // Associa um evento de tecla para coletar dados quando "Enter" é pressionado
    NovoDadoA.addEventListener("keydown", function(event) {
        if (event.keyCode === 13) {
            GuardaA = NovoDadoA.value; // Adiciona o valor do campo de entrada ao array
           if(isNaN(parseInt(GuardaA) )){
            alert("você deve inserir números")
           }else{createInputA(); // Cria um novo campo de entrada
           }
           
           
        }
    });
}


createInputA(); // Cria o primeiro campo de entrada


var DadoAntigoB = null; // Variável para rastrear o último campo de entrada
var GuardaB = "amostra_b[]"; // variavel com id

function createInputB() {
    var NovoDadoB = document.createElement("input");
    NovoDadoB.type = "number";
    document.body.appendChild(NovoDadoB);
    NovoDadoB.focus();
    DadoAntigoB = NovoDadoB;
    
    // Associa um evento de tecla para coletar dados quando "Enter" é pressionado
    NovoDadoB.addEventListener("keydown", function(event) {
        if (event.keyCode === 13) {
            GuardaB = NovoDadoB.value; // Adiciona o valor do campo de entrada ao array
           if(isNaN(parseInt(GuardaB) )){
            alert("você deve inserir números")
           }else{createInputB(); // Cria um novo campo de entrada
           }
           
           
        }
    });
}


createInputB(); // Cria o primeiro campo de entrada