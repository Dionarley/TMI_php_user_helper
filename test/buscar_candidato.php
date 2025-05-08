<?php
header('Content-Type: application/json');

// Dados de conexão com o banco
$host = 'localhost';
$dbname = 'my_php_test';  
$user = 'phptest';          
$pass = 'phptest';            


// Conexão
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["erro" => "Erro na conexão com o banco de dados."]));
}

// Recebe CPF via GET ou POST
$cpf = $_GET['cpf'] ?? $_POST['cpf'] ?? null;
if (!$cpf || !preg_match('/^\d{11}$/', $cpf)) {
    http_response_code(400);
    die(json_encode(["erro" => "CPF inválido ou não informado."]));
}

// Busca no banco
$sql = "SELECT data_fim_contrato FROM ex_funcionarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->bind_result($data_fim);

if ($stmt->fetch()) {
    $carencia_meses = 6;
    $data_fim_dt = new DateTime($data_fim);
    $hoje = new DateTime();

    $intervalo = $data_fim_dt->diff($hoje);
    $meses_passados = $intervalo->y * 12 + $intervalo->m;

    if ($meses_passados >= $carencia_meses) {
        echo json_encode(["status" => "apto", "mensagem" => "Candidato pode se inscrever."]);
    } else {
        echo json_encode([
            "status" => "inapto",
            "mensagem" => "Candidato deve aguardar {$carencia_meses} meses após o fim do contrato.",
            "meses_passados" => $meses_passados
        ]);
    }
} else {
    echo json_encode(["status" => "novo", "mensagem" => "CPF não consta como ex-funcionário."]);
}

$stmt->close();
$conn->close();
?>
