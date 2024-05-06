<?php
// Inicia a sessão
session_start();

// Verifica se há um erro na URL
if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<div class='alert alert-danger text-center' role='alert' style='font-size: 20px;'>Usuário ou senha incorretos.</div>";
}

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Realize a autenticação como você fez antes
    // Se a autenticação for bem-sucedida, defina uma variável de sessão para indicar que o usuário está autenticado
    $_SESSION['authenticated'] = true;
    // Redireciona para a página protegida
    header("Location: home.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal F5 - Login</title>
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

<div class="container">
    <!-- Logo -->
    <div class="row justify-content-center mt-3 mb-5">
        <div class="col-md-6 text-center">
            <img src="logo.png" alt="Logo" style="width: 200px;">
        </div>
    </div>
    <h2 class="text-center">Bem-vindo ao portal F5</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form action="autenticacao.php" method="post">
                        <div class="form-group">
                            <label for="username">Usuário:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Scripts do Bootstrap e dependências -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
