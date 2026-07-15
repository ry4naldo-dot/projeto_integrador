<?php

$id_empresa = auth()->id;

$curriculo = $database->query(
    sql: "select * from curriculos c
    inner join vagas as v on c.id_vagas = v.id
    where v.id_empresas = :id_empresa",
    class: Curriculo::class,
    params: ['id_empresa' => $id_empresa]
)->fetchAll();


view('Curriculos', compact('curriculo'));