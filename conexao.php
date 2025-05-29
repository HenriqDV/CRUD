<?php
// Define o nome do servidor onde está o banco de dados.
// "localhost" significa que o banco está na mesma máquina que o servidor web.
$host = "localhost:3307";

// Define o nome do usuário do banco de dados. Em servidores locais, geralmente é "root".
$user = "root";

// Define a senha do banco de dados. Em servidores locais, geralmente é uma string vazia (sem senha).
$pass = "";

// Define o nome do banco de dados que será acessado.
$dbname = "escola";

// Cria a conexão com o banco de dados usando a extensão MySQLi (MySQL Improved)
// A variável $conn passa a ser o objeto de conexão.
$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica se houve erro na tentativa de conexão com o banco.
if ($conn->connect_error) {
    // Se houve erro, o script é encerrado (die) e mostra a mensagem de erro.
    die("Conexão falhou: " . $conn->connect_error);
}
// Se não houver erro, a conexão foi realizada com sucesso e o script continua normalmente.
?>
