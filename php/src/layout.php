<!DOCTYPE html>
<html lang="en" >
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>Estatística</title>
	  <link rel="stylesheet" href="./style.css">

	</head>
<body id='bod'>
<!-- partial:index.partial.html -->
    <div class="container">
      <header class="slideRight">
        <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
        <ul id="navToggle" class="burger slideRight">
          <!--	Add "slideRight" class to items that move right when viewing Nav Drawer  -->
          <li></li>
          <li></li>
          <li></li>
        </ul>
        <h1><a href="#">VI Gincana de Estatística</a></h1>
      </header>
      <nav class="slideLeft">
        <ul>
          <li><a href="#" class="active" onclick="inicio()"><i class="dgicon-home"></i> Início</a></li>
          <!-- <li><a href="#"><i class="dgicon-users"></i> Início</a></li> -->
          <li><a href="#" id="conceito" onclick="conceitos()"><i class="dgicon-tools"></i> Conceitos</a></li>
          <li><a href="#"><i class="dgicon-vcard"></i> Quiz Estatístico</a></li>
          <li><a href="#"><i class="dgicon-vcard"></i> Calcule</a></li>
          <li><a href="#"><i class="dgicon-window"></i> Fórum de Dúvidas</a></li>
          <li><a href="#"><i class="dgicon-window"></i> Entre/Cadastre-se</a></li>
        </ul>
      </nav>
      <div class="content slideRight page" id="tela">
      </div>
      <a href="#"><h5 id='sobre'>VI Turma de Sistemas de Informação © - Todos os Direitos Reservados</h5><a>
    </div>
    </body>
    </html>

  <script  src="./script.js"></script>
 
  <script>
	   function inicio(){
		  $("#tela").empty();
		  $("#tela").css({
		  "background-image": "url(img/inicio1.png)",
		  "background-size": "100%",
		  "background-repeat": "no-repeat",
	      "width": "100% !important"
		  });
        }
	  
       function conceitos(){
          $("#tela").css({backgroundImage: "none" });
          $("#ul_conceitos").remove();
          $("#tela").append('<style>#conceitos_body{background-color: #fab200;}.a_conceitos{text-align: center;text-decoration: none;font-weight: bold;color: black;margin: 0;position: absolute;top: 50%;left: 50%;margin-right: -50%;transform: translate(-50%, -50%);cursor: pointer;}.a_conceitos:hover{color: #fab200;}#ul_conceitos{margin-top: 20px;margin-left: 10%;margin-right: 10%;}.li_conceitos{list-style: none;border-style: solid;border-color: white;float: left;height: 60px;width: 200px;font-size: 20px;margin-right: 50px;margin-bottom: 70px;position: relative;background-color: white;border-radius: 15px;}</style><ul id="ul_conceitos"><li class="li_conceitos"><a class="a_conceitos" href="#">Estatística Descritiva</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">População</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Amostra</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Dado x Variável</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Variável Resposta</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Tabelas</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Distribuição de Frequências</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Gráficos</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Medidas Descritivas</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Medidas Separatrizes</a></li><li class="li_conceitos"><a class="a_conceitos" href="#">Medidas de Disperção</a></li></ul>');

        }
    </script>
  


</body>
</html>
