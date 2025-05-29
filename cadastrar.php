<?php
// Verifica se o formulário foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria uma nova conexão com o banco de dados MySQL usando mysqli
    $mysqli = new mysqli("localhost:3307", "root", "", "escola");

    // Verifica se houve erro na conexão
    if ($mysqli->connect_errno) {
        // Se houver erro, exibe a mensagem e encerra o script
        die("Erro ao conectar: " . $mysqli->connect_error);
    }

    // Recebe os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $curso = $_POST['curso'];

    // Prepara a query SQL para inserir um novo aluno
    $stmt = $mysqli->prepare("INSERT INTO alunos (nome, email, matricula, curso) VALUES (?, ?, ?, ?)");
    // Faz o bind dos parâmetros recebidos do formulário na query preparada
    $stmt->bind_param("ssss", $nome, $email, $matricula, $curso);
    // Executa a query
    $stmt->execute();

    // Após cadastrar, redireciona para a página inicial
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- Define o charset da página -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade em dispositivos móveis -->
    <title>Cadastrar Aluno</title> <!-- Título da aba do navegador -->
    <!-- Importa o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Importa os ícones do Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light"> <!-- Define o fundo da página como claro -->

  <div class="container mt-5"> <!-- Container centralizado com margem superior -->
    <div class="card shadow"> <!-- Card com sombra -->
      <div class="card-header bg-success text-white"> <!-- Cabeçalho do card com fundo verde -->
        <h5 class="mb-0"><i class="bi bi-person-plus"></i> Cadastrar Novo Aluno</h5> <!-- Título e ícone -->
      </div>
      <div class="card-body"> <!-- Corpo do card -->
        <!-- Formulário para cadastrar o aluno, método POST -->
        <form method="POST">
          <div class="form-floating mb-3">
            <!-- Campo de texto para o nome -->
            <input type="text" class="form-control" name="nome" id="nome" required>
            <label for="nome">Nome</label>
          </div>

          <div class="form-floating mb-3">
            <!-- Campo de email -->
            <input type="email" class="form-control" name="email" id="email" required>
            <label for="email">E-mail</label>
          </div>

          <div class="form-floating mb-3">
            <!-- Campo de texto para matrícula -->
            <input type="text" class="form-control" name="matricula" id="matricula" required>
            <label for="matricula">Matrícula</label>
          </div>

          <div class="form-floating mb-4">
            <!-- Campo de texto para curso -->
            <input type="text" class="form-control" name="curso" id="curso" required>
            <label for="curso">Curso</label>
          </div>

          <div class="d-flex justify-content-between">
            <!-- Botão para voltar para a página inicial -->
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
            <!-- Botão para enviar o formulário e cadastrar o aluno -->
            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>