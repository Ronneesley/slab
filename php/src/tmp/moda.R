conjunto <- c('gui','a','b','gui')
moda <- function(v) { 
uniqv <- unique(v) 
uniqv[which.max(tabulate(match(v, uniqv)))] 
} 
moda(conjunto) 
