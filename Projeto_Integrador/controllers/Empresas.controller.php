<?php

$empresa = $database->query(
    sql: "select * from empresas where id = :id",
    class: Empresa::class,
    params:['id' => $_REQUEST['id']]
)->fetchAll();

// dd($empresa);

view('Empresas', compact('empresa'));