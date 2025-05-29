<?php
// Inclui o arquivo de conexão com o banco de dados
include("conexao.php");

// Monta a consulta SQL para selecionar todos os alunos
$sql = "SELECT * FROM alunos";
// Executa a consulta e armazena o resultado
$result = $conn->query($sql);

// Verifica se a consulta retornou algum registro
if ($result->num_rows > 0) {
    // Exibe o título da lista
    echo "<h2>Lista de Usuários</h2>";
    // Inicia a tabela HTML
    echo "<table border='1'>";
    // Cabeçalho da tabela
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Matricula</th><th>Curso</th><th>Ações</th></tr>";
    
    // Percorre cada linha retornada pela consulta
    while($row = $result->fetch_assoc()) {
        // Inicia uma nova linha na tabela
        echo "<tr>";
        // Exibe o ID do aluno
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        // Exibe o nome do aluno
        echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
        // Exibe o email do aluno
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        // Exibe a matrícula do aluno
        echo "<td>" . htmlspecialchars($row["matricula"]) . "</td>";
        // Exibe o curso do aluno
        echo "<td>" . htmlspecialchars($row["curso"]) . "</td>";

        // Adiciona links para editar e deletar, passando o ID como parâmetro GET
        echo "<td><a href='editar.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Editar</a>
                  <a href='deletar.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Deletar</a></td>";
        // Fecha a linha da tabela
        echo "</tr>";
    }
    // Fecha a tabela HTML
    echo "</table>";
} else {
    // Caso não haja registros, exibe mensagem
    echo "Nenhum usuário encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
