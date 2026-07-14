<?php

$curriculo = $database->query(
    sql: "select * from curriculos",
    class: Curriculo::class
)->fetchAll();
// dd($curriculo);

view('Curriculos', compact('curriculo'));