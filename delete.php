<?php

/**
 * Melhoria: Em vez de chamar a conexão e escrever SQL solto,
 * incluímos a classe User para usar os métodos que já estão prontos.
 */
require __DIR__ . "/User.php";

/**
 * Captura o parâmetro "id" enviado pela URL
 * e valida se ele é um número inteiro válido (evitando SQL Injection).
 *
 * Exemplo: delete.php?id=3
 */
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

/**
 * Se o ID não for válido ou não for numérico, interrompe a execução com um link amigável.
 */
if (!$id) {
    die("ID inválido ou não fornecido. <a href='index.php'>Voltar para a lista</a>");
}

/**
 * Instancia a classe User e chama o método delete()
 */
$userObj = new User();
$sucesso = $userObj->delete($id);

if ($sucesso) {
    /**
     * Redireciona o usuário de volta para a página principal após excluir.
     */
    header("Location: index.php");
    exit;
} else {
    die("Erro ao tentar excluir o aluno. <a href='index.php'>Voltar para a lista</a>");
}