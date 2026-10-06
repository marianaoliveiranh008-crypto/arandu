<?php
function validarEmailViaAPI(string $email): array {
    $apiKey = "SUA_API_KEY_AQUI"; // Insira sua chave da API aqui
    $url = "https://emailvalidation.abstractapi.com/v1/?api_key={$apiKey}&email=" . urlencode($email);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);

    $resposta = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 && $resposta) {
        $dados = json_decode($resposta, true);
        
        $formatoValido = $dados['is_valid_format']['value'] ?? false;
        $naoEhDescartavel = !($dados['is_disposable_email']['value'] ?? true);
        $deliverable = ($dados['deliverability'] ?? '') === 'DELIVERABLE';

        if ($formatoValido && $naoEhDescartavel && $deliverable) {
            return ['valido' => true, 'mensagem' => 'E-mail válido.'];
        }
        return ['valido' => false, 'mensagem' => 'E-mail inválido, temporário ou inexistente.'];
    }

    $validoPadrao = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    return [
        'valido' => $validoPadrao, 
        'mensagem' => $validoPadrao ? 'E-mail em formato válido' : 'E-mail inválido.'
    ];
}