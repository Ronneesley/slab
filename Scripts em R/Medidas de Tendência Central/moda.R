# Script em R para calcular a moda de um determinado conjunto de dados

moda <- function(v) {
   uniqv <- unique(v)
   uniqv[which.max(tabulate(match(v, uniqv)))]
}

# Conjunto de dados.
v <- c(2,1,2,3,1,2,3,4,1,5,5,3,2,3,1,1,1)

# Calculando a moda utilizando a função.
resultado <- moda(v)
print(resultado)

# Utilizando um conjunto de dados textual.
dados <- c("oi","oi","teste","oi","teste")

# Calculando a moda utilizando strings como parametro.
resultado <- moda(dados)
print(resultado)  
