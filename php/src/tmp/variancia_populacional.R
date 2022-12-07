conjunto <- c(1,2,3)
variancia_populacional <- function(x){ 
n <- length(x) 
var(x)*(n-1)/n 
} 
variancia_populacional(conjunto) 
