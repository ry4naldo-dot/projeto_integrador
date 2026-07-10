<?php

$VagasRecentes = $database->query(
    sql: "select * from empresas",
    class: Empresa::class
    // params: ['filtro' => "%$pesquisar%"]
)->fetchAll();

view('index');
