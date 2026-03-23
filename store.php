<?php

/**
 * Melhoria: Incluímos a classe User para manter a arquitetura Orientada a Objetos.
 * O arquivo connect.php já é chamado dentro de User.php.
 */
require __DIR__ . "/User.php";

/**
 * Melhoria de Segurança e Validação:
 * Utilizando filter_input() conforme sugerido nos objetivos da atividade.
 * Isso limpa os dados (evita XSS) e valida se o formato do e-mail é real.
 */
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);

/**
 * Validação mais robusta:
 * Verifica se os campos não estão vazios e se o e-mail passou na validação.
 */
if (!$name || !$email || !$document) {
    // Retorna um link para voltar caso a validação falhe, melhorando a usabilidade.
    die("Erro: Dados inválidos. Verifique se todos os campos foram preenchidos corretamente e se o e-mail é válido. <br><br><a href='index.php'>Voltar</a>");
}

/**
 * Instancia a classe User e utiliza o método create()
 * centralizando a regra de negócio.
 */
$userObj = new User();
$sucesso = $userObj->create($name, $email, $document);

if ($sucesso) {
    // Redireciona de volta para a listagem com sucesso
    header("Location: index.php");
    exit;
} else {
    die("Erro ao cadastrar o aluno no banco de dados. <a href='index.php'>Voltar</a>");
}