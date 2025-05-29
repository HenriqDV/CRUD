<?php
// Inclui a conexão com o banco
include("conexao.php");

// Obtém os dados enviados via POST
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$matricula = $_POST['matricula'];
$curso = $_POST['curso'];

// Prepara a consulta SQL de atualização
$sql = "UPDATE alunos SET nome='$nome', email='$email', matricula='$matricula', curso='$curso' WHERE id=$id";

// Executa a atualização e verifica se foi bem-sucedida
if ($conn->query($sql) === TRUE) {
    // Se deu certo, exibe mensagem de sucesso e link para voltar
    echo "Usuário atualizado com sucesso.<br>";
    echo "<a href='listar.php'>Voltar para a lista</a>";
} else {
    // Se deu erro, exibe mensagem de erro
    echo "Erro ao atualizar: " . $conn->error;
}

// Fecha a conexão
$conn->close();
?>
