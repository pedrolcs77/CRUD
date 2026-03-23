<?php

/**
 * Melhoria: Incluímos a classe User (que já puxa a conexão)
 * para utilizar o padrão de Orientação a Objetos, evitando queries
 * soltas no arquivo de visualização.
 */
require __DIR__ . "/User.php";

$userObj = new User();
$users = $userObj->all();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP - Sistema de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h1 class="mb-4 text-center text-primary">Gestão de Alunos</h1>

        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Cadastrar Novo Aluno</h5>
            </div>
            <div class="card-body">
                <form action="store.php" method="post" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nome Completo:</label>
                        <input type="text" name="name" class="form-control" placeholder="Digite o nome" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">E-mail:</label>
                        <input type="email" name="email" class="form-control" placeholder="aluno@email.com" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Curso:</label>
                        <input type="text" name="document" class="form-control" placeholder="Ex: Gestão de TI" required>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-success px-4">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3 text-secondary">Alunos Matriculados</h5>
                
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Curso</th>
                                <th>Cadastrado em</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td class="text-center"><?= $user["id"] ?></td>
                                    <td><?= htmlspecialchars($user["name"]) ?></td>
                                    <td><?= htmlspecialchars($user["email"]) ?></td>
                                    <td><?= htmlspecialchars($user["document"]) ?></td>
                                    <td><?= date("d/m/Y H:i", strtotime($user["created_at"])) ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $user["id"] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <a href="delete.php?id=<?= $user["id"] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir o aluno <?= htmlspecialchars($user["name"]) ?>?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <?php if (count($users) === 0): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">Nenhum aluno cadastrado no momento.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="6" class="text-end fw-bold">Total de alunos: <?= count($users) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>