<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se um arquivo JSON foi enviado
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $json_data = file_get_contents($_FILES["file"]["tmp_name"]);
        $data = json_decode($json_data, true);

        // Preenche os campos de entrada com os dados do JSON
        if (isset($data["nome"])) {
            echo '<script>document.getElementById("nome").value = "' . $data["nome"] . '";</script>';
        }
        if (isset($data["email"])) {
            echo '<script>document.getElementById("email").value = "' . $data["email"] . '";</script>';
        }
    }
}
?> 
