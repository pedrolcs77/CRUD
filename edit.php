<?php

/**
 * Melhoria: Incluímos o arquivo da classe User para utilizar a 
 * Orientação a Objetos em vez de fazer consultas diretas no banco.
 */
require __DIR__ . "/User.php";

/**
 * Captura o parâmetro "id" enviado pela URL
 * e valida se ele é um número inteiro válido (proteção contra SQL Injection).
 *
 * Exemplo de URL: edit.php?id=3
 */
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

/**
 * Se o ID não for válido, o script é interrompido com uma mensagem amigável.
 */
if (!$id) {
    die("ID inválido. <a href='index.php'>Voltar para a lista</a>");
}

/**
 * Instancia a classe User e utiliza o método findById()
 * para buscar os dados do aluno específico.
 */
$userObj = new User();
$user = $userObj->findById($id);

/**
 * Se nenhum aluno for encontrado, interrompe a execução.
 */
if (!$user) {
    die("Aluno não encontrado. <a href='index.php'>Voltar para a lista</a>");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno - CRUD PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Editar Cadastro do Aluno</h5>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="post">
                            
                            <input type="hidden" name="id" value="<?= $user["id"] ?>">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nome Completo:</label>
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user["name"]) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">E-mail:</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user["email"]) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Curso:</label>
                                <input type="text" name="document" class="form-control" value="<?= htmlspecialchars($user["document"]) ?>" required>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="index.php" class="btn btn-outline-secondary">Voltar</a>
                                <button type="submit" class="btn btn-warning">Atualizar Dados</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>