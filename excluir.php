<?php
// Verifica se o parâmetro 'id' foi passado via GET na URL
if (!isset($_GET['id'])) {
    // Se não foi passado, redireciona para a página inicial
    header("Location: index.php");
    exit;
}

// Cria uma nova conexão com o banco de dados MySQL usando mysqli
$mysqli = new mysqli("localhost:3307", "root", "", "escola");

// Verifica se houve erro na conexão
if ($mysqli->connect_errno) {
    // Se houver erro, exibe a mensagem e encerra o script
    die("Erro ao conectar: " . $mysqli->connect_error);
}

// Converte o valor do parâmetro 'id' para inteiro para evitar SQL Injection
$id = intval($_GET['id']);
// Executa a query para deletar o aluno com o id informado
$mysqli->query("DELETE FROM alunos WHERE id = $id");

// Após excluir, redireciona para a página inicial
header("Location: index.php");
exit;
?>