<?php
$mysqli = new mysqli("localhost:3307", "root", "", "escola");

if ($mysqli->connect_errno) {
    die("Erro ao conectar: " . $mysqli->connect_error);
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $curso = $_POST['curso'];

    $stmt = $mysqli->prepare("UPDATE alunos SET nome=?, email=?, matricula=?, curso=? WHERE id=?");
    $stmt->bind_param("ssssi", $nome, $email, $matricula, $curso, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

$result = $mysqli->query("SELECT * FROM alunos WHERE id = $id");
$aluno = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Aluno</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-warning">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Aluno</h5>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="nome" id="nome" value="<?= htmlspecialchars($aluno['nome']) ?>" required>
            <label for="nome">Nome</label>
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($aluno['email']) ?>" required>
            <label for="email">E-mail</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="matricula" id="matricula" value="<?= htmlspecialchars($aluno['matricula']) ?>" required>
            <label for="matricula">Matrícula</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" name="curso" id="curso" value="<?= htmlspecialchars($aluno['curso']) ?>" required>
            <label for="curso">Curso</label>
          </div>

          <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Cancelar</a>
            <button type="submit" class="btn btn-warning"><i class="bi bi-save"></i> Atualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>