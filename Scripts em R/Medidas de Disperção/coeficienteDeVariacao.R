#Script em R realizado para calcular coeficiente de variacao de um determinado conjunto de dados.


1. Com desvio padrão amostral:

conjunto <- c(7, 8, 9, 10, 10, 11, 11, 12, 13)

cv <- sd(conjunto ) / mean(conjunto ) * 100


2. Com desvio padrão populacional:

conjunto <- c(7, 8, 9, 10, 10, 11, 11, 12, 13)

cv <- sqrt(mean((conjunto-mean(conjunto))^2) /  mean(conjunto ) * 100