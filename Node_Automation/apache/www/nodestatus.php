<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>F5 Node Status</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">F5 Node Status</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="node.html">Node Manager</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="nodestatus.php">Node Status <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <img src="logo.png" alt="Logo" class="d-block mx-auto mb-4" style="width: 200px;">
    <h2 class="text-center mb-4">F5 Node Status</h2>

    <!-- Tabela para exibir as informações de status -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Node</th>
                    <th scope="col">IP</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="jenkinsTableBody">
                <!-- PHP para preencher a tabela com os dados do banco de dados -->
                <?php
                // Conexão com o banco de dados
                $host = $_ENV['POSTGRES_HOST'];
                $dbname = $_ENV['POSTGRES_DB'];
                $user = $_ENV['POSTGRES_USER'];
                $password = $_ENV['POSTGRES_PASSWORD'];

                $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

                // Verifica se a conexão foi estabelecida com sucesso
                if (!$conn) {
                    echo "<tr><td colspan='3'>Não foi possível conectar ao banco de dados.</td></tr>";
                } else {
                    // Consulta SQL para obter os dados da tabela nodes
                    $query = "SELECT tmname, addr, enabledstate FROM nodes";

                    // Executa a consulta SQL
                    $result = pg_query($conn, $query);

                    // Preenche a tabela com os dados do banco de dados
                    while ($row = pg_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['tmname'] . "</td>";
                        echo "<td>" . $row['addr'] . "</td>";
                        echo "<td>" . $row['enabledstate'] . "</td>";
                        echo "</tr>";
                    }

                    // Fecha a conexão com o banco de dados
                    pg_close($conn);
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
