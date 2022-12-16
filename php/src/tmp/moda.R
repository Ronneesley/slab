conjunto <- c(1,2,3,2,2,3)
moda <- function(v) { 
uniqv <- unique(v) 
uniqv[which.max(tabulate(match(v, uniqv)))] 
} 
moda(conjunto) 
