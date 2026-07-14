<?php

$vagas = $database->query(
    sql: "SELECT 
            v.*, 
            e.nome_empresa 
          FROM vagas v
          INNER JOIN empresas e ON v.id_empresas = e.id
          WHERE v.id = :id",
    class: Vagas::class,
    params: ['id' => $_REQUEST['id']]
)->fetch();

view('Vaga', compact('vagas')); 
