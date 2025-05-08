<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recrutamento | Verificar Candidato</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; }
        h1 { color: #333; }
        input, button {
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            width: 100%;
        }
        #resultado {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }
        .apto { background-color: #d4edda; color: #155724; }
        .inapto { background-color: #f8d7da; color: #721c24; }
        .novo { background-color: #cce5ff; color: #004085; }
        .erro { background-color: #fff3cd; color: #856404; }
    </style>
</head>
<body>
    <h1>Verificar Elegibilidade de Candidato</h1>
    <form id="form-busca">
        <label for="cpf">Digite o CPF (somente números):</label>
        <input type="text" id="cpf" name="cpf" maxlength="11" required>
        <button type="submit">Verificar</button>
    </form>

    <div id="resultado"></div>

    <script>
        document.getElementById('form-busca').addEventListener('submit', function(e) {
            e.preventDefault();
            const cpf = document.getElementById('cpf').value;

            fetch('./test/buscar_candidato.php?cpf=' + encodeURIComponent(cpf))
                .then(res => res.json())
                .then(data => {
                    const res = document.getElementById('resultado');
                    res.className = data.status || 'erro';
                    res.innerHTML = '<strong>' + data.m
