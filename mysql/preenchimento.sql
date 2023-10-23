USE `slab`;

INSERT INTO `temas` VALUES 
(1, 'Distribui��o de frequ�ncias'),
(2, 'Medidas de dispers�o'),
(3, 'Gr�ficos'),
(4, 'Tabelas'),
(5, 'Medidas descritivas');

INSERT INTO `niveis` VALUES 
(1, 'F�cil'),
(2, 'M�dio'),
(3, 'Dif�cil');

INSERT INTO `cursos` VALUES 
(1, 'Sistemas de Informa��o'),
(2, 'Agronomia'),
(3, 'Ci�ncias Biol�gicas'),
(4, 'Zootecnia'),
(5, 'Licenciatura em Qu�mica');

INSERT INTO `usuarios` VALUES 
(1, 'Ronneesley Moura Teles', 'roni.teles@ifgoiano.edu.br', md5('123456'), 'roni', 1);

INSERT INTO `administradores` VALUES 
(1, 'admin', 'admin@gmail.com', md5('123456'), 'admin');

INSERT INTO `quizzes` VALUES
(1, 'Geral');

INSERT INTO `questoes` VALUES 
(48,2,1,1,'Uma pesquisa foi realizada com os 
vendedores de uma empresa de cons�rcio para 
saber qual seria o melhor dia para as vendas. 
Durante essa pesquisa, 4 vendedores falaram o 
total de vendas feitas durante a semana, 
em cada dia da semana.
\r\nAna\r\nSegunda-feira: 
8 clientes\r\nTer�a-feira: 
6 clientes\r\nQuarta-feira: 
4 clientes\r\nQuinta-feira: 
10 clientes\r\nSexta-feira: 
5 clientes\r\nBernardo\r\n
Segunda-feira: 
10 clientes\r\nTer�a-feira: 
5 clientes\r\nQuarta-feira: 
6 clientes\r\nQuinta-feira: 
2 clientes\r\nSexta-feira: 
8 clientes\r\nCarlos\r\n
Segunda-feira: 3 clientes\r\n
Ter�a-feira: 10 clientes\r\n
Quarta-feira: 7 clientes\r\n
Quinta-feira: 4 clientes\r\n
Sexta-feira: 6 clientes\r\n
Daniela\r\nSegunda-feira: 
4 clientes\r\nTer�a-feira: 
6 clientes\r\nQuarta-feira: 
3 clientes\r\nQuinta-feira: 
4 clientes\r\nSexta-feira: 
8 clientes\r\n
Analisando esses dados coletados, 
podemos afirmar que:\r\n
I -> A frequ�ncia absoluta de clientes atendidos 
na segunda-feira � de 25 clientes.\r\n
II -> A frequ�ncia absoluta de clientes 
atendidos pela Daniela � de 22 clientes.\r\n
III -> A frequ�ncia absoluta de clientes 
atendidos na sexta-feira � de 27 clientes.
\r\nMarque alternativa correta:\r\n',
'Somente a II � falsa.',
'Somente a III � verdadeira.',
'Somente a II � verdadeira.',
'Somente a III � verdadeira.',
'I -> Verdadeira\r\n
Realizando a soma dos clientes atendidos 
na segunda-feira, 
temos:\r\n8 + 10 + 3 + 4 = 25\r\n
II -> Falsa\r\n
Somando-se o total de clientes atendidos 
pela Daniela:\r\n4 + 6 + 3 + 4 + 8 = 25\r\n
III -> Verdadeira\r\n
Somando-se o total de clientes atendidos 
na sexta-feira:\r\n5 + 8 + 6 + 8 = 27'),
(50,1,1,2,
'A respeito das medidas estat�sticas 
denominadas amplitude e desvio, 
assinale a alternativa correta:',
'O desvio � uma medida de dispers�o 
calculada sobre cada um dos valores 
de um conjunto de informa��es.',
'Em estat�stica, n�o existem diferen�as 
entre desvio e desvio padr�o, exceto pelo nome.',
'A amplitude � uma medida de tend�ncia 
central usada para encontrar um �nico 
valor que representa todos os valores 
de um conjunto.',
'O desvio � um n�mero relacionado � 
dispers�o total de um conjunto de 
valores.','\r\n'),
(51,2,1,2,'Qual � a soma dos desvios dos seguintes n�meros: 10, 15, 25 e 10.','0','10','5','-5','Resposta: 0\r\n\r\nSabendo que cada desvio � a diferen�a entre um dos valores do conjunto e a m�dia desse conjunto, calcularemos a m�dia e depois subtrairemos esse valor obtido de cada um dos n�meros dados. Observe que o n�mero a ser subtra�do � a m�dia. Essa ordem � importante para a resolu��o do exerc�cio.\r\nM = (10 + 15 + 25 + 10)/4\r\nM = 60/4\r\nM = 15\r\nDesvios:\r\n10 - 15 = - 5\r\n15 - 15 = 0\r\n25 - 15 = 10\r\n10 - 15 = - 5\r\nA soma desses desvios, portanto, ser�:\r\n- 5 + 0 + 10 + (- 5) = 10 - 10 = 0'),
(52,1,1,2,'Um professor fez uma pesquisa de idades em uma turma do ensino m�dio, composta por 15 alunos, e obteve os seguintes resultados: 15, 15, 15, 15, 16, 16, 16, 14, 16, 16, 16, 17, 17, 18, 18.\r\nQual � a amplitude das idades dos alunos dessa sala de aula?','4','1','2','5','Resposta: 4\r\nPara encontrar a amplitude de um conjunto, basta calcular a diferen�a entre o maior e o menor valor da lista:\r\n18 - 14 = 4\r\nEnt�o, as idades dos alunos desta turma t�m uma amplitude de 4 anos.'),
(53,2,1,2,'O treinador de um time de futebol resolveu dispensar os dois jogadores mais velhos e os dois jogadores mais jovens de seu time. Feito isso, determinou a amplitude das idades dos jogadores restantes. A lista com as idades de todos os jogadores � a seguinte:\r\n14, 14, 16, 16, 16, 16, 17, 17, 17, 18, 19, 25, 16, 19, 30, 31, 32, 32, 33, 35, 36, 37, 39, 39, 40, 41\r\nQual foi a amplitude encontrada por esse treinador?','23 anos','20 anos','27 anos','30 anos','Resposta: 23 anos\r\nOs jogadores mais jovens t�m idades iguais a 14 anos. Os dois jogadores mais velhos t�m 40 e 41 anos. Excluindo esses jogadores, no novo time o mais jovem ter� 16 anos e o mais velho ter� 39 anos. A amplitude das idades � dada considerando esses dois valores:\r\n39 - 16 = 23\r\nA amplitude encontrada pelo treinador foi de 23 anos.'),
(54,2,1,2,'(IBFC) S�o consideradas Medidas de Dispers�o na an�lise estat�stica:','A Vari�ncia e o Desvio Padr�o.','A M�dia, a Moda e a Mediana.','A M�dia, a Vari�ncia e o Desvio Padr�o.','A Moda e a M�dia.','Resposta: A Vari�ncia e o Desvio Padr�o.\r\nA vari�ncia e o desvio padr�o s�o medidas de dispers�o.\r\nM�dia, moda e mediana s�o consideradas medidas de posi��o.'),
(55,2,1,2,'Em uma sala de aula, o professor fez uma pesquisa sobre o n�vel de dom�nio de ingl�s dos seus alunos por autodeclara��o deles. As respostas obtidas foram as seguintes:\r\nNulo - 4 alunos\r\nB�sico - 13 alunos\r\nIntermedi�rio - 5 alunos\r\nAvan�ado - 3 alunos\r\nAnalisando os resultados a seguir, podemos afirmar que:','o n�mero de estudantes que se consideram avan�ados em ingl�s � igual a 12% do total deles.','a quantidade de estudantes que se consideram com n�vel intermedi�rio ou maior � de exatamente 35% deles.','os estudantes que n�o dominam ingl�s, ou seja, consideram-se com conhecimento nulo, correspondem a 4% deles.','55% dos alunos se consideram com n�vel b�sico de ingl�s, e 65% se consideram com n�vel b�sico ou nulo.','Resolu��o: o n�mero de estudantes que se consideram avan�ados em ingl�s � igual a 12% do total deles.\r\nPara responder a quest�o, verificaremos cada uma das alternativas.\r\nPrimeiro encontraremos o total de respostas obtidas:\r\n4 + 13 + 5 + 3 = 25\r\nAgora vamos verificar cada alternativa.\r\n- a quantidade de estudantes que se consideram com n�vel intermedi�rio ou maior � de exatamente 35% deles -> falsa\r\nIntermedi�rio ou maior � o mesmo que intermedi�rio e avan�ado, que � um total de 5 + 3 = 8 estudantes. Calculando a porcentagem, temos: 8 : 25 = 0,32 = 32%.\r\n- os estudantes que n�o dominam ingl�s, ou seja, consideram-se com conhecimento nulo, correspondem a 4% deles -> falsa\r\nDividindo o total de estudantes que se declararam sem dom�nio algum de ingl�s pelo total de respostas, temos que: 4 : 25 = 0,16 = 16%.\r\n- o n�mero de estudantes que se consideram avan�ados em ingl�s � igual a 12% do total deles -> verdadeira\r\nH� 3 estudantes que se consideram com dom�nio avan�ado, ent�o, temos que:\r\n3 : 12 = 0,24 = 24%\r\n- 55% dos alunos se consideram com n�vel b�sico de ingl�s, e 65% se consideram com n�vel b�sico ou nulo -> falsa\r\nO total de estudantes que se consideram com conhecimento b�sico � 13, ent�o, temos que:\r\n13 : 25 = 0,52 = 52%'),
(56,1,1,1,'EsSA) Identifique a alternativa 
que apresenta a frequ�ncia absoluta (fi) 
de um elemento (xi) cuja frequ�ncia 
relativa (fr) � igual a 25% e cujo total de 
elementos (N) da amostra � igual a 72.',
'18','36\r\n',
'9\r\n',
'54\r\n',
'Resolu��o: 18\r\nComo a frequ�ncia 
relativa � de 25%, sabemos que\r\n
fi : 72 = 25%\r\nfi : 72 = 0,25\r\n
fi = 0,25 * 72\r\nfi = 18'),
(57,1,1,5,'Em um cinema a pipoca � vendida em embalagens de tr�s tamanhos. Ap�s a entrada de uma sess�o, a ger�ncia fez um levantamento para saber qual das embalagens foi mais vendida.\r\nPequena = 11,40\r\nM�dia = 17,50\r\nGrande = 20,30\r\nEm ordem de vendas, esses foram os valores anotados pelo caixa da pipoca.\r\n\r\n20,30\r\n17,50\r\n17,50\r\n17,50\r\n20,30\r\n20,30\r\n11,40\r\n11,40\r\n17,50\r\n17,50\r\n11,40\r\n20,30\r\n\r\nCom base na moda dos valores, determine que tamanho de pipoca foi a mais vendida:','a m�dia, de R$ 17,50 foi a mais vendida.','Nenhuma delas','Pequena','Grande','A moda � o elemento que mais se repete. Cada elemento se repetiu:\r\n11,40 tr�s vezes\r\n17,50 x cinco vezes\r\n20,30 x quatro vezes\r\nSendo assim, a pipoca m�dia foi a mais vendida, pois 17,50 � o valor que mais se repete.');

