<?php
header('Content-Type: application/json');

// Recebe a mensagem do nosso JavaScript
$dados = json_decode(file_get_contents("php://input"), true);
$mensagemUsuario = $dados['mensagem'] ?? '';

if (!$mensagemUsuario) {
    echo json_encode(['response' => 'Mensagem vazia.']);
    exit;
}

// 1. CORREÇÃO DA URL: Adicionamos o /get no final
$urlReplit = "https://649b2929-5bf7-436f-842a-69246cc4b6e5-00-rlhpr1vj2zhh.spock.replit.dev/get";

// 2. CORREÇÃO DO FORMATO: O Flask espera request.form.get("msg"), então usamos http_build_query
$dadosParaReplit = http_build_query([
    'msg' => $mensagemUsuario
]);

$ch = curl_init($urlReplit);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dadosParaReplit);
// 3. CORREÇÃO DO CABEÇALHO: Avisa o Python que estamos mandando dados de formulário
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
    'Content-Length: ' . strlen($dadosParaReplit)
]);

// AS LINHAS MÁGICAS PARA O XAMPP NÃO BLOQUEAR O HTTPS
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$respostaReplit = curl_exec($ch);
$erro = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Tratamento de erros
if ($erro) {
    echo json_encode(['response' => 'Erro interno do cURL: ' . $erro]);
} elseif ($httpCode !== 200 && $httpCode !== 201) {
    echo json_encode(['response' => 'O Replit retornou erro HTTP: ' . $httpCode]);
} else {
    // Retorna a resposta exata que o seu Flask mandou (que já é um JSON com a chave "response")
    echo $respostaReplit; 
}