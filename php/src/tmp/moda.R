conjunto <- c(4,4,8)
moda <- function(v) { 
uniqv <- unique(v) 
uniqv[which.max(tabulate(match(v, uniqv)))] 
} 
moda(conjunto) 
