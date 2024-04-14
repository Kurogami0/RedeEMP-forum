<?php
// Conexão com o banco de dados
$servername = "localhost"; // endereço do servidor
$username = "seu_usuario"; // seu nome de usuário do banco de dados
$password = "sua_senha"; // sua senha do banco de dados
$dbname = "nome_do_banco"; // nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Cria tabela para usuários
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'usuarios' criada com sucesso\n";
} else {
    echo "Erro ao criar tabela: " . $conn->error . "\n";
}

// Cria tabela para categorias de fórum
$sql = "CREATE TABLE IF NOT EXISTS categorias (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'categorias' criada com sucesso\n";
} else {
    echo "Erro ao criar tabela: " . $conn->error . "\n";
}

// Cria tabela para fóruns
$sql = "CREATE TABLE IF NOT EXISTS forums (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT(6) UNSIGNED,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'forums' criada com sucesso\n";
} else {
    echo "Erro ao criar tabela: " . $conn->error . "\n";
}

// Cria tabela para tópicos
$sql = "CREATE TABLE IF NOT EXISTS topicos (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    forum_id INT(6) UNSIGNED,
    usuario_id INT(6) UNSIGNED,
    titulo VARCHAR(255) NOT NULL,
    data_postagem TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (forum_id) REFERENCES forums(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'topicos' criada com sucesso\n";
} else {
    echo "Erro ao criar tabela: " . $conn->error . "\n";
}

// Insere dados iniciais nas tabelas (exemplo)
$sql = "INSERT INTO categorias (nome, descricao) VALUES ('Geral', 'Discussões gerais sobre a RedeEMP')";
$conn->query($sql);

$sql = "INSERT INTO forums (categoria_id, nome, descricao) VALUES (1, 'Apresentações', 'Apresente-se à comunidade')";
$conn->query($sql);

$sql = "INSERT INTO forums (categoria_id, nome, descricao) VALUES (1, 'Dúvidas', 'Perguntas e respostas sobre a RedeEMP')";
$conn->query($sql);

// Fecha conexão
$conn->close();
?>
