conjunto <- c(9,8,7,6,5,4,5,3,2,1)
desvio_populacional <- function(x){ 
n <- length(x) 
a <- var(x)*(n-1)/n  
sqrt(a) 
} 
(desvio_populacional(conjunto) / mean(conjunto) * 100.0)