<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mysqli = new mysqli("localhost:3307", "root", "", "escola");

    if ($mysqli->connect_errno) {
        die("Erro ao conectar: " . $mysqli->connect_error);
    }

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $curso = $_POST['curso'];

    $stmt = $mysqli->prepare("INSERT INTO alunos (nome, email, matricula, curso) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $matricula, $curso);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Aluno</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="bi bi-person-plus"></i> Cadastrar Novo Aluno</h5>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="nome" id="nome" required>
            <label for="nome">Nome</label>
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" required>
            <label for="email">E-mail</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="matricula" id="matricula" required>
            <label for="matricula">Matrícula</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" name="curso" id="curso" required>
            <label for="curso">Curso</label>
          </div>

          <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>