<?php
session_start();

// Verifica se o usuário não está autenticado
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // Redireciona para a página de login
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F5 Node Manager</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        .sidebar {
            background-color: #f8f9fa;
            padding: 20px;
            margin-top: 56px; /* Tamanho da barra de navegação */
        }
        .button-section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Barra de navegação -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">F5 Node Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- Links da barra de navegação -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="node.php">Node Manager</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nodestatus.php">Node Status</a>
            </li>
            <!-- Adicione outros links conforme necessário -->
        </ul>
        <!-- Botão de logoff -->
        <form class="form-inline my-2 my-lg-0" action="logout.php" method="post">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logoff</button>
        </form>
    </div>
</nav>


<!-- Conteúdo principal -->
<div class="container mt-5">
    <!-- Logo -->
    <img src="logo.png" alt="Logo" class="d-block mx-auto mb-4" style="width: 200px;">
    <!-- Título -->
    <h2 class="text-center mb-4">F5 Node Manager</h2>
    <!-- Formulário -->
    <form id="jenkinsForm" action="submit.php" method="post" onsubmit="return submitForm()" class="text-center">
        <!-- Campo de seleção -->
        <label for="action">Action:</label>
        <select id="action" name="action" class="form-control mb-3">
            <option value="enabled">enabled</option>
            <option value="disabled">disabled</option>
        </select>
        <!-- Campo de entrada de texto -->
        <label for="node">Node:</label>
        <input type="text" id="node" name="node" placeholder="Digite o nome do Node" class="form-control mb-3">
        <!-- Botão de envio -->
        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
    </form>
</div>

<!-- Script para enviar o formulário via AJAX -->
<script>
function submitForm() {
    var form = document.getElementById("jenkinsForm");
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Mostra uma mensagem de sucesso se o envio for bem-sucedido
                alert("Solicitação Realizada com Sucesso!");
                // Limpa o formulário após o envio bem-sucedido
                form.reset();
            } else {
                // Mostra uma mensagem de erro se ocorrer um erro durante o envio
                alert("Erro ao enviar o formulário. Tente novamente mais tarde.");
            }
        }
    };
    xhr.send(formData);
    return false; // Isso impede o envio normal do formulário
}
</script>

<!-- Scripts do Bootstrap e dependências -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
