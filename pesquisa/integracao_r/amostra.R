x <- rnorm(6,0,1)
png(filename="test.png",  width=500, height=500)
hist(x, col="green", main="teste")
dev.off()
