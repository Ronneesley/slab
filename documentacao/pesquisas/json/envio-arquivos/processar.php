<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $caminhoUploads = "uploads/";

    $nomeArquivo = "dados.txt";

    $caminhoCompleto = $caminhoUploads . $nomeArquivo;

    // Abrindo o arquivo para escrita no diretório uploads
    $arquivo = fopen($caminhoCompleto, "w");

    if ($arquivo) {
        $dados = "Nome: $nome\nE-mail: $email\n";
        fwrite($arquivo, $dados);

        fclose($arquivo);

        // Redirecione o usuário de volta para a página de confirmação
        header("Location: salvarDados.html");
        exit; // Encerre o script para evitar que o código abaixo seja executado
    } else {
        echo "Erro ao abrir o arquivo para escrita.";
    }
}
?>
