# Script em R para calcular a variância populacional de um determinado conjunto de dados

variancia_populacional <- function(x){
  n <- length(x) # calcula o tamanho da amostra com a função lenght()
  var(x)*(n-1)/n # calcula a variância amostral e multiplica por (n-1)/n
}

conjunto <- c(2,3,5,7,9,5,2,6)

variancia_populacional(conjunto)
