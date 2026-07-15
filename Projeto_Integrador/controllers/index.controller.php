<?php

$pesquisar = $_REQUEST['pesquisar'] ?? '';
$modelo    = $_REQUEST['modelo'] ?? '';


$sql = "SELECT 
            v.id,
            e.nome_empresa, 
            v.descricao, 
            v.tipo, 
            v.valor, 
            v.modelo,
            e.endereco  
          FROM vagas v
          INNER JOIN empresas e ON v.id_empresas = e.id";

// Criamos uma lista de condições e outra de parâmetros
$condicoes = [];
$params = [];

// 2. Filtro por termo de pesquisa
if (!empty($pesquisar)) {
    $condicoes[] = "(v.descricao LIKE :pesquisar OR e.nome_empresa LIKE :pesquisar)";
    $params['pesquisar'] = "%$pesquisar%";
}

// 3. Filtro por Modelo de Trabalho
if (!empty($modelo)) {
    $condicoes[] = "v.modelo = :modelo";
    $params['modelo'] = $modelo;
}

// 4. Se houver alguma condição preenchida, junta todas com "AND" no SQL
if (count($condicoes) > 0) {
    $sql .= " WHERE " . implode(" AND ", $condicoes);
}

// 5. Executa a busca integrada
$VagasRecentes = $database->query(
    sql: $sql,
    class: Vagas::class,
    params: $params
)->fetchAll();

view('index', compact('VagasRecentes'));