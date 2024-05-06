<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os valores dos parâmetros do formulário
    $action = $_POST['action'];
    $node = $_POST['node'];

    // Monta o comando curl com os parâmetros
    $command = "curl -X POST -L --user api:11324fe0ff062a8587b7fd25cdf4538634 " .
               "--data-urlencode action=" . urlencode($action) . " " .
               "--data-urlencode node=" . urlencode($node) . " " .
               "http://10.121.87.71:8081/job/F5_Node-Automation/buildWithParameters?token=jenkins100gosto";

    // Executa o comando curl
    exec($command, $output, $status);

}
?>
