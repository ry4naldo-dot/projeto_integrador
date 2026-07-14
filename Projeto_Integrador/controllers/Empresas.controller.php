<?php

$empresa = $database->query(
    sql: "select * from empresas",
    class: Empresa::class
)->fetchAll();

// dd($empresa);

view('Empresas', compact('empresa'));