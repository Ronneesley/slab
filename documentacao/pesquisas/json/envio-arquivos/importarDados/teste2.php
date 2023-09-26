<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o arquivo foi enviado corretamente
    if (isset($_FILES['jsonFile']) && $_FILES['jsonFile']['error'] === UPLOAD_ERR_OK) {
        $jsonFile = $_FILES['jsonFile']['tmp_name'];

        // Lê o conteúdo do arquivo JSON
        $jsonData = file_get_contents($jsonFile);

        if ($jsonData !== false) {
            // Decodifica o JSON para um array associativo
            $data = json_decode($jsonData, true);

            if ($data !== null) {
                $nome = $data['nome'];
                $email = $data['email'];
            } else {
                echo "Erro ao decodificar o JSON.";
            }
        } else {
            echo "Erro ao ler o arquivo JSON.";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulário</title>
</head>
<body>
    <form action="teste2.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $nome ?? ''; ?>"><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email ?? ''; ?>"><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
