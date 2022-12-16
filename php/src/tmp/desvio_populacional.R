conjunto <- c(1,2,3)
desvio_populacional <- function(x){ 
n <- length(x) 
a <- var(x)*(n-1)/n  
sqrt(a) 
} 
desvio_populacional(conjunto) 
