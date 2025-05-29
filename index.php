<?php
// Cria uma nova conexão com o banco de dados MySQL usando mysqli
$mysqli = new mysqli("localhost:3307", "root", "", "escola");

// Verifica se houve erro na conexão
if ($mysqli->connect_errno) {
    // Se houver erro, exibe a mensagem e encerra o script
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Executa a consulta para buscar todos os alunos cadastrados
$resultado = $mysqli->query("SELECT * FROM alunos");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- Define o charset da página -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade em dispositivos móveis -->
    <title>Lista de Alunos</title> <!-- Título da aba do navegador -->
    <!-- Importa o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Importa os ícones do Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light"> <!-- Define o fundo da página como claro -->

  <div class="container mt-5"> <!-- Container centralizado com margem superior -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
      <h2 class="text-primary">📚 Sistema de Alunos</h2> <!-- Título do sistema -->
      <a href="cadastrar.php" class="btn btn-success"> <!-- Botão para cadastrar novo aluno -->
        <i class="bi bi-plus-lg"></i> Novo Aluno
      </a>
    </div>

    <div class="card shadow"> <!-- Card com sombra para a tabela -->
      <div class="card-header bg-primary text-white"> <!-- Cabeçalho do card com fundo azul -->
        <h5 class="mb-0">Lista de Alunos</h5> <!-- Título do card -->
      </div>
      <div class="card-body p-0"> <!-- Corpo do card sem padding -->
        <div class="table-responsive"> <!-- Tabela responsiva -->
            <table class="table table-striped table-hover mb-0 align-middle"> <!-- Tabela com listras e hover -->
                <thead class="table-ligth"> <!-- Cabeçalho da tabela -->
                    <tr>
                        <th>ID</th> <!-- Coluna ID -->
                        <th>Nome</th> <!-- Coluna Nome -->
                        <th>Email</th> <!-- Coluna Email -->
                        <th>Matrícula</th> <!-- Coluna Matrícula -->
                        <th>Curso</th> <!-- Coluna Curso -->
                        <th>Ações</th> <!-- Coluna Ações -->
                    </tr>
                </thead>
                <tbody>
                  <?php while ($aluno = $resultado->fetch_assoc()): ?> <!-- Loop para cada aluno retornado do banco -->
                    <tr>
                      <td><?= $aluno['id'] ?></td> <!-- Exibe o ID do aluno -->
                      <td><?= htmlspecialchars($aluno['nome']) ?></td> <!-- Exibe o nome do aluno -->
                      <td><?= htmlspecialchars($aluno['email']) ?></td> <!-- Exibe o email do aluno -->
                      <td><?= htmlspecialchars($aluno['matricula']) ?></td> <!-- Exibe a matrícula do aluno -->
                      <td><?= htmlspecialchars($aluno['curso']) ?></td> <!-- Exibe o curso do aluno -->
                      <td>
                        <!-- Botão para editar o aluno -->
                        <a href="editar.php?id=<?= $aluno['id'] ?>" class="btn btn-warning btn-sm">
                          <i class="bi bi-pencil"></i> Editar
                        </a>
                        <!-- Botão para abrir o modal de confirmação de exclusão -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalExcluir<?= $aluno['id'] ?>">
                          <i class="bi bi-trash"></i> Excluir
                        </button>

                        <!-- Modal de confirmação de exclusão -->
                        <div class="modal fade" id="modalExcluir<?= $aluno['id'] ?>" tabindex="-1" aria-labelledby="modalExcluirLabel<?= $aluno['id'] ?>" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="modalExcluirLabel<?= $aluno['id'] ?>">Confirmar Exclusão</h5> <!-- Título do modal -->
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button> <!-- Botão para fechar o modal -->
                              </div>
                              <div class="modal-body">
                                Tem certeza que deseja excluir o aluno <strong><?= htmlspecialchars($aluno['nome']) ?></strong>? <!-- Mensagem de confirmação -->
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> <!-- Botão para cancelar -->
                                <a href="excluir.php?id=<?= $aluno['id'] ?>" class="btn btn-danger">Excluir</a> <!-- Botão para excluir o aluno -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?> <!-- Fim do loop dos alunos -->
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Importa o JS do Bootstrap para funcionamento dos modais -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>