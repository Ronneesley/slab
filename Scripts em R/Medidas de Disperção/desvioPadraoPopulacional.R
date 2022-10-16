#Script em R realizado para calcular desvio padrão populacional de um determinado conjunto de dados.

conjunto <- c(7, 8, 9, 10, 10, 11, 11, 12, 13)

sqrt(mean((conjunto-mean(conjunto))^2)