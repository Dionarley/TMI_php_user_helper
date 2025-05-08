<?php
$host = 'localhost';
$dbname = 'my_php_test';
$user = 'phptest';
$pass = 'phptest';


// Conexão com o banco de dados
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT * FROM tabela_exemplo";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Exibe os dados
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão
$conn->close();
?>

