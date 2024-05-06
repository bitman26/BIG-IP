<?php
// Inicia a sessão
session_start();

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém as credenciais do formulário e evita possíveis ataques de SQL injection
    $username = pg_escape_string($_POST["username"]);
    $password = pg_escape_string($_POST["password"]);

    // Conexão com o banco de dados
    $host = $_ENV['POSTGRES_HOST'];
    $dbname = $_ENV['POSTGRES_DB_USERS'];
    $user = $_ENV['POSTGRES_USER'];
    $db_password = $_ENV['POSTGRES_PASSWORD'];

    $conn = pg_connect("host=$host dbname=$dbname user=$user password=$db_password");

    if (!$conn) {
        echo "Erro ao conectar ao banco de dados.";
    } else {
        // Consulta o banco de dados para verificar as credenciais
        $query = "SELECT * FROM users WHERE username = $1";
        $result = pg_query_params($conn, $query, array($username));

        if (!$result) {
            echo "Erro ao executar a consulta.";
        } else {
            // Verifica se o usuário foi encontrado
            if (pg_num_rows($result) == 1) {
                $row = pg_fetch_assoc($result);
                $stored_password_hash = $row["password_hash"];

                // Verifica se a senha corresponde ao hash armazenado
                if (password_verify($password, $stored_password_hash)) {
                    // Autenticação bem-sucedida, defina uma variável de sessão para indicar que o usuário está autenticado
                    $_SESSION['authenticated'] = true;
                    // Redireciona para a página protegida
                    header("Location: home.php");
                    exit(); // Certifique-se de sair do script para evitar que mais conteúdo seja enviado ao cliente
                } else {
                    // Redireciona de volta para a página inicial com mensagem de erro
                    header("Location: index.php?error=1");
                    exit();
                }
            } else {
                // Redireciona de volta para a página inicial com mensagem de erro
                header("Location: index.php?error=1");
                exit();
            }
        }
    }

    // Fecha a conexão com o banco de dados
    pg_close($conn);
}
?>
