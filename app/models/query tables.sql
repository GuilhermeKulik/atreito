CREATE TABLE Cliente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    codigo_usuario VARCHAR(50) UNIQUE,
    email VARCHAR(255),
    celular VARCHAR(20),
    data_nascimento DATE,
    endereco_rua VARCHAR(255),
    endereco_numero VARCHAR(10),
    endereco_complemento VARCHAR(255),
    endereco_bairro VARCHAR(100),
    endereco_cidade VARCHAR(100),
    endereco_estado VARCHAR(50),
    endereco_cep VARCHAR(20),
    genero VARCHAR(20),
    cpf_cnpj VARCHAR(20),
    observacoes TEXT,
    foto VARCHAR(255),
    status VARCHAR(20),
    tipo_cliente VARCHAR(50),
    pontos INT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ultimo_login TIMESTAMP,
    INDEX(codigo_usuario),
    INDEX(email)
);



