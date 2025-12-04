<?php
header("Content-Type: application/json");

// Caminho do arquivo JSON
$arquivo = "pedidos.json";

// Recebe o JSON enviado pelo JavaScript
$dados = json_decode(file_get_contents("php://input"), true);

if (!$dados) {
    echo json_encode(["erro" => "Nenhum dado recebido"]);
    exit;
}

// Se o arquivo não existir, cria um array inicial
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([]));
}

// Lê o conteúdo atual
$pedidos = json_decode(file_get_contents($arquivo), true);

// Adiciona o novo pedido com horário
date_default_timezone_set("America/Sao_Paulo");
$dados["timestamp"] = date("Y-m-d H:i:s");
$pedidos[] = $dados;

// Salva novamente no arquivo
file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT));

// Retorno para a aplicação
echo json_encode(["status" => "ok", "mensagem" => "Pedido salvo com sucesso"]);
