<?php

/**
 * Melhoria: Incluímos a classe User para centralizar as operações do banco.
 */
require __DIR__ . "/User.php";

/**
 * Captura e valida o ID enviado pelo formulário via POST.
 * O ID deve ser um número inteiro válido.
 */
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

/**
 * Melhoria de Segurança:
 * Substituímos o trim() básico por filter_input() para sanitizar
 * os dados e validar o formato do e-mail de forma segura.
 */
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);

/**
 * Validação reforçada:
 * Verifica se o ID é válido e se nenhum campo obrigatório ficou de fora.
 */
if (!$id || !$name || !$email || !$document) {
    // Redireciona de volta para a tela de edição em caso de erro nos dados
    die("Dados inválidos. Verifique se os campos estão preenchidos corretamente. <a href='edit.php?id=$id'>Voltar para edição</a>");
}

/**
 * Instancia a classe User e executa o método update(),
 * passando os dados limpos e validados.
 */
$userObj = new User();
$sucesso = $userObj->update($id, $name, $email, $document);

if ($sucesso) {
    /**
     * Redireciona o usuário para a página principal após atualizar.
     */
    header("Location: index.php");
    exit;
} else {
    die("Erro ao tentar atualizar o aluno no banco de dados. <a href='edit.php?id=$id'>Voltar para edição</a>");
}