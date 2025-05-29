<?php
// Cria uma nova conexão com o banco de dados MySQL usando mysqli
$mysqli = new mysqli("localhost:3307", "root", "", "escola");

// Verifica se houve erro na conexão
if ($mysqli->connect_errno) {
    // Se houver erro, exibe a mensagem e encerra o script
    die("Erro ao conectar: " . $mysqli->connect_error);
}

// Verifica se o parâmetro 'id' foi passado via GET na URL
if (!isset($_GET['id'])) {
    // Se não foi passado, redireciona para a página inicial
    header("Location: index.php");
    exit;
}

// Converte o valor do parâmetro 'id' para inteiro para evitar SQL Injection
$id = intval($_GET['id']);

// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $curso = $_POST['curso'];

    // Prepara a query SQL para atualizar os dados do aluno
    $stmt = $mysqli->prepare("UPDATE alunos SET nome=?, email=?, matricula=?, curso=? WHERE id=?");
    // Faz o bind dos parâmetros recebidos do formulário na query preparada
    $stmt->bind_param("ssssi", $nome, $email, $matricula, $curso, $id);
    // Executa a query
    $stmt->execute();

    // Após atualizar, redireciona para a página inicial
    header("Location: index.php");
    exit;
}

// Busca os dados do aluno no banco para preencher o formulário
$result = $mysqli->query("SELECT * FROM alunos WHERE id = $id");
// Pega os dados do aluno como array associativo
$aluno = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- Define o charset da página -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade em dispositivos móveis -->
    <title>Editar Aluno</title> <!-- Título da aba do navegador -->
    <!-- Importa o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> <!-- Define o fundo da página como claro -->

<div class="container mt-5"> <!-- Container centralizado com margem superior -->
    <div class="card shadow"> <!-- Card com sombra -->
      <div class="card-header bg-warning"> <!-- Cabeçalho do card com fundo amarelo -->
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Aluno</h5> <!-- Título e ícone -->
        </div>
      <div class="card-body"> <!-- Corpo do card -->
        <!-- Formulário para editar o aluno, método POST -->
        <form method="POST">
          <div class="form-floating mb-3">
            <!-- Campo de texto para o nome, preenchido com o valor atual do aluno -->
            <input type="text" class="form-control" name="nome" id="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" required>
            <label for="nome">Nome</label>
        </div>

          <div class="form-floating mb-3">
            <!-- Campo de email, preenchido com o valor atual -->
            <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($aluno['email']) ?>" required>
            <label for="email">E-mail</label>
        </div>

          <div class="form-floating mb-3">
            <!-- Campo de texto para matrícula, preenchido com o valor atual -->
            <input type="text" class="form-control" name="matricula" id="matricula" value="<?= htmlspecialchars($aluno['matricula']) ?>" required>
            <label for="matricula">Matrícula</label>
        </div>

          <div class="form-floating mb-4">
            <!-- Campo de texto para curso, preenchido com o valor atual -->
            <input type="text" class="form-control" name="curso" id="curso" value="<?= htmlspecialchars($aluno['curso']) ?>" required>
            <label for="curso">Curso</label>
          </div>

          <div class="d-flex justify-content-between">
            <!-- Botão para cancelar e voltar para a página inicial -->
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Cancelar</a>
            <!-- Botão para enviar o formulário e atualizar o aluno -->
            <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Atualizar</button>
        </div>
    </form>
</div>
    </div>
  </div>

</body>
</html>