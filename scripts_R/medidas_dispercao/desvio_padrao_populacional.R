# Script em R para calcular a desvio padrão populacional de um determinado conjunto de dados

desvio_populacional <- function(x){
  n <- length(x) # calcula o tamanho da amostra com a função lenght()
  a <- var(x)*(n-1)/n # calcula a variância amostral e multiplica por (n-1)/n
  sqrt(a) # calcula a raiz quadrada da variância populacional, ou seja, o desvio padrão populacional

}

conjunto <- c(2,4,5,3)

desvio_populacional(conjunto)
