CREATE TABLE IF NOT EXISTS ex_funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    data_fim_contrato DATE NOT NULL
);

INSERT INTO ex_funcionarios (cpf, data_fim_contrato) VALUES
('11111111111', DATE_SUB(CURDATE(), INTERVAL 8 MONTH)),  -- apto
('22222222222', DATE_SUB(CURDATE(), INTERVAL 3 MONTH)),  -- inapto
('33333333333', CURDATE());                              -- recém desligado
