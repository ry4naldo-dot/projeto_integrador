<?php

$VagasRecentes = $database->query(
    sql: "select 
            e.nome_empresa, 
            v.descricao, 
            v.tipo, 
            v.valor, 
            v.modelo,
            e.endereco  
          FROM vagas v
          INNER JOIN empresas e ON v.id_empresas = e.id",
    class: Vagas::class
)->fetchAll();

view('index', compact('VagasRecentes'));
