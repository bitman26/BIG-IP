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
    <title>Portal F5</title>
    <!-- Estilos padrão -->
    <link rel="stylesheet" type="text/css" href="default.css">
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
    <a class="navbar-brand" href="#">Portal F5</a>
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
<!-- Logo -->
<img src="logo.png" alt="Logo" class="d-block mx-auto mt-5 mb-4" style="width: 200px;">
<!-- Título -->
<h2 class="text-center">Bem-vindo ao portal F5</h2>
<!-- Parágrafo de boas-vindas -->
<p class="text-center">Bem-vindo ao portal F5, seu hub de inovação e automação para gerenciamento de redes.</p>

<!-- Scripts do Bootstrap e dependências -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
