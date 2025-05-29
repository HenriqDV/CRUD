<?php
$mysqli = new mysqli("localhost:3307", "root", "", "escola");

if ($mysqli->connect_errno) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

$resultado = $mysqli->query("SELECT * FROM alunos");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciamento de Alunos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="text-primary">📚 Sistema de Alunos</h2>
      <a href="cadastrar.php" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Novo Aluno
      </a>
    </div>

    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Lista de Alunos</h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Matrícula</th>
                <th>Curso</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($aluno = $resultado->fetch_assoc()): ?>
              <tr>
                <td><?= $aluno['id'] ?></td>
                <td><?= htmlspecialchars($aluno['nome']) ?></td>
                <td><?= htmlspecialchars($aluno['email']) ?></td>
                <td><?= htmlspecialchars($aluno['matricula']) ?></td>
                <td><?= htmlspecialchars($aluno['curso']) ?></td>
                <td>
                  <a href="editar.php?id=<?= $aluno['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil"></i> Editar
                  </a>
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $aluno['id'] ?>">
                    <i class="bi bi-trash"></i> Excluir
                  </button>

                  <div class="modal fade" id="modalExcluir<?= $aluno['id'] ?>" tabindex="-1" aria-labelledby="modalExcluirLabel<?= $aluno['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                          <h5 class="modal-title" id="modalExcluirLabel<?= $aluno['id'] ?>">Confirmar Exclusão</h5>
                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                          Tem certeza que deseja excluir o aluno <strong><?= htmlspecialchars($aluno['nome']) ?></strong>?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <a href="excluir.php?id=<?= $aluno['id'] ?>" class="btn btn-danger">Excluir</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>