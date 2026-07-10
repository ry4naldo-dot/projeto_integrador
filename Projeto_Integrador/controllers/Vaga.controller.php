<?php

$vagas = $database->query(
    sql: "select * from empresas where id = :id",
    class: Empresa::class,
    params:['id' => $_REQUEST['id']]
)->fetch();

view('Vaga'); 