USE `slab`;

INSERT INTO `temas` VALUES 
(1, 'Distribuição de frequências'),
(2, 'Medidas de dispersão'),
(3, 'Gráficos'),
(4, 'Tabelas'),
(5, 'Medidas descritivas');

INSERT INTO `niveis` VALUES 
(1, 'Fácil'),
(2, 'Médio'),
(3, 'Difícil');

INSERT INTO `cursos` VALUES 
(1, 'Sistemas de Informação'),
(2, 'Agronomia'),
(3, 'Ciências Biológicas'),
(4, 'Zootecnia'),
(5, 'Licenciatura em Química');

INSERT INTO `usuarios` VALUES 
(1, 'Ronneesley Moura Teles', 'roni.teles@ifgoiano.edu.br', md5('123456'), 'roni', 1);

INSERT INTO `administradores` VALUES 
(1, 'admin', 'admin@gmail.com', md5('123456'), 'admin');

INSERT INTO `quizzes` VALUES
(1, 'Geral');

INSERT INTO `questoes` VALUES 
(48,2,1,1,'Uma pesquisa foi realizada com os vendedores de uma empresa de consórcio para saber qual seria o melhor dia para as vendas. Durante essa pesquisa, 4 vendedores falaram o total de vendas feitas durante a semana, em cada dia da semana.\r\nAna\r\nSegunda-feira: 8 clientes\r\nTerça-feira: 6 clientes\r\nQuarta-feira: 4 clientes\r\nQuinta-feira: 10 clientes\r\nSexta-feira: 5 clientes\r\nBernardo\r\nSegunda-feira: 10 clientes\r\nTerça-feira: 5 clientes\r\nQuarta-feira: 6 clientes\r\nQuinta-feira: 2 clientes\r\nSexta-feira: 8 clientes\r\nCarlos\r\nSegunda-feira: 3 clientes\r\nTerça-feira: 10 clientes\r\nQuarta-feira: 7 clientes\r\nQuinta-feira: 4 clientes\r\nSexta-feira: 6 clientes\r\nDaniela\r\nSegunda-feira: 4 clientes\r\nTerça-feira: 6 clientes\r\nQuarta-feira: 3 clientes\r\nQuinta-feira: 4 clientes\r\nSexta-feira: 8 clientes\r\nAnalisando esses dados coletados, podemos afirmar que:\r\nI → A frequência absoluta de clientes atendidos na segunda-feira é de 25 clientes.\r\nII → A frequência absoluta de clientes atendidos pela Daniela é de 22 clientes.\r\nIII → A frequência absoluta de clientes atendidos na sexta-feira é de 27 clientes.\r\nMarque alternativa correta:\r\n','Somente a II é falsa.','Somente a III é verdadeira.','Somente a II é verdadeira.','Somente a III é verdadeira.','I → Verdadeira\r\nRealizando a soma dos clientes atendidos na segunda-feira, temos:\r\n8 + 10 + 3 + 4 = 25\r\nII → Falsa\r\nSomando-se o total de clientes atendidos pela Daniela:\r\n4 + 6 + 3 + 4 + 8 = 25\r\nIII →  Verdadeira\r\nSomando-se o total de clientes atendidos na sexta-feira:\r\n5 + 8 + 6 + 8 = 27'),
(50,1,1,2,'A respeito das medidas estatísticas denominadas amplitude e desvio, assinale a alternativa correta:','O desvio é uma medida de dispersão calculada sobre cada um dos valores de um conjunto de informações.','Em estatística, não existem diferenças entre desvio e desvio padrão, exceto pelo nome.','A amplitude é uma medida de tendência central usada para encontrar um único valor que representa todos os valores de um conjunto.','O desvio é um número relacionado à dispersão total de um conjunto de valores.','\r\n                '),
(51,2,1,2,'Qual é a soma dos desvios dos seguintes números: 10, 15, 25 e 10.','0','10','5','-5','Resposta: 0\r\n\r\nSabendo que cada desvio é a diferença entre um dos valores do conjunto e a média desse conjunto, calcularemos a média e depois subtrairemos esse valor obtido de cada um dos números dados. Observe que o número a ser subtraído é a média. Essa ordem é importante para a resolução do exercício.\r\nM = (10 + 15 + 25 + 10)/4\r\nM = 60/4\r\nM = 15\r\nDesvios:\r\n10 – 15 = – 5\r\n15 – 15 = 0\r\n25 – 15 = 10\r\n10 – 15 = – 5\r\nA soma desses desvios, portanto, será:\r\n– 5 + 0 + 10 + (– 5) = 10 – 10 = 0'),
(52,1,1,2,'Um professor fez uma pesquisa de idades em uma turma do ensino médio, composta por 15 alunos, e obteve os seguintes resultados: 15, 15, 15, 15, 16, 16, 16, 14, 16, 16, 16, 17, 17, 18, 18.\r\nQual é a amplitude das idades dos alunos dessa sala de aula?','4','1','2','5','Resposta: 4\r\nPara encontrar a amplitude de um conjunto, basta calcular a diferença entre o maior e o menor valor da lista:\r\n18 – 14 = 4\r\nEntão, as idades dos alunos desta turma têm uma amplitude de 4 anos.'),
(53,2,1,2,'O treinador de um time de futebol resolveu dispensar os dois jogadores mais velhos e os dois jogadores mais jovens de seu time. Feito isso, determinou a amplitude das idades dos jogadores restantes. A lista com as idades de todos os jogadores é a seguinte:\r\n14, 14, 16, 16, 16, 16, 17, 17, 17, 18, 19, 25, 16, 19, 30, 31, 32, 32, 33, 35, 36, 37, 39, 39, 40, 41\r\nQual foi a amplitude encontrada por esse treinador?','23 anos','20 anos','27 anos','30 anos','Resposta: 23 anos\r\nOs jogadores mais jovens têm idades iguais a 14 anos. Os dois jogadores mais velhos têm 40 e 41 anos. Excluindo esses jogadores, no novo time o mais jovem terá 16 anos e o mais velho terá 39 anos. A amplitude das idades é dada considerando esses dois valores:\r\n39 – 16 = 23\r\nA amplitude encontrada pelo treinador foi de 23 anos.'),
(54,2,1,2,'(IBFC) São consideradas Medidas de Dispersão na análise estatística:','A Variância e o Desvio Padrão.','A Média, a Moda e a Mediana.','A Média, a Variância e o Desvio Padrão.','A Moda e a Média.','Resposta: A Variância e o Desvio Padrão.\r\nA variância e o desvio padrão são medidas de dispersão.\r\nMédia, moda e mediana são consideradas medidas de posição.'),
(55,2,1,2,'Em uma sala de aula, o professor fez uma pesquisa sobre o nível de domínio de inglês dos seus alunos por autodeclaração deles. As respostas obtidas foram as seguintes:\r\nNulo – 4 alunos\r\nBásico – 13 alunos\r\nIntermediário – 5 alunos\r\nAvançado – 3 alunos\r\nAnalisando os resultados a seguir, podemos afirmar que:','o número de estudantes que se consideram avançados em inglês é igual a 12% do total deles.','a quantidade de estudantes que se consideram com nível intermediário ou maior é de exatamente 35% deles.','os estudantes que não dominam inglês, ou seja, consideram-se com conhecimento nulo, correspondem a 4% deles.','55% dos alunos se consideram com nível básico de inglês, e 65% se consideram com nível básico ou nulo.','Resolução: o número de estudantes que se consideram avançados em inglês é igual a 12% do total deles.\r\nPara responder a questão, verificaremos cada uma das alternativas.\r\nPrimeiro encontraremos o total de respostas obtidas:\r\n4 + 13 + 5 + 3 = 25\r\nAgora vamos verificar cada alternativa.\r\n- a quantidade de estudantes que se consideram com nível intermediário ou maior é de exatamente 35% deles → falsa\r\nIntermediário ou maior é o mesmo que intermediário e avançado, que é um total de 5 + 3 = 8 estudantes. Calculando a porcentagem, temos: 8 : 25 = 0,32 = 32%.\r\n- os estudantes que não dominam inglês, ou seja, consideram-se com conhecimento nulo, correspondem a 4% deles → falsa\r\nDividindo o total de estudantes que se declararam sem domínio algum de inglês pelo total de respostas, temos que: 4 : 25 = 0,16 = 16%.\r\n- o número de estudantes que se consideram avançados em inglês é igual a 12% do total deles → verdadeira\r\nHá 3 estudantes que se consideram com domínio avançado, então, temos que:\r\n3 : 12 = 0,24 = 24%\r\n- 55% dos alunos se consideram com nível básico de inglês, e 65% se consideram com nível básico ou nulo → falsa\r\nO total de estudantes que se consideram com conhecimento básico é 13, então, temos que:\r\n13 : 25 = 0,52 = 52%'),
(56,1,1,1,'EsSA) Identifique a alternativa que apresenta a frequência absoluta (fi) de um elemento (xi) cuja frequência relativa (fr) é igual a 25% e cujo total de elementos (N) da amostra é igual a 72.','18','36\r\n                ','9\r\n                ','54\r\n                ','Resolução: 18\r\nComo a frequência relativa é de 25%, sabemos que\r\nfi : 72 = 25%\r\nfi : 72 = 0,25\r\nfi = 0,25 ⋅ 72\r\nfi = 18'),
(57,1,1,5,'Em um cinema a pipoca é vendida em embalagens de três tamanhos. Após a entrada de uma sessão, a gerência fez um levantamento para saber qual das embalagens foi mais vendida.\r\nPequena = 11,40\r\nMédia = 17,50\r\nGrande = 20,30\r\nEm ordem de vendas, esses foram os valores anotados pelo caixa da pipoca.\r\n\r\n20,30\r\n17,50\r\n17,50\r\n17,50\r\n20,30\r\n20,30\r\n11,40\r\n11,40\r\n17,50\r\n17,50\r\n11,40\r\n20,30\r\n\r\nCom base na moda dos valores, determine que tamanho de pipoca foi a mais vendida:','a média, de R$ 17,50 foi a mais vendida.','Nenhuma delas','Pequena','Grande','A moda é o elemento que mais se repete. Cada elemento se repetiu:\r\n11,40 três vezes\r\n17,50 x cinco vezes\r\n20,30 x quatro vezes\r\nSendo assim, a pipoca média foi a mais vendida, pois 17,50 é o valor que mais se repete.');
