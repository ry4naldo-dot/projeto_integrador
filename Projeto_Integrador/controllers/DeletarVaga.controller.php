<?php

if (!auth()) {
    header('Location: /login');
    exit();
}

$id_vaga = $_REQUEST['id'] ?? null;

if (!$id_vaga) {
    header('Location: /');
    exit();
}

$vaga = $database->query(
    sql: "select * from vagas where id = :id",
    class: Vagas::class,
    params: ['id' => $id_vaga]
)->fetch();

// Se a vaga não existir, volta para a home
if (!$vaga) {
    header('Location: /');
    exit();
}


// Garante que ninguém delete a vaga de outra empresa mudando o ID na URL
if (!isset($_SESSION['auth']->nome_empresa) || $_SESSION['auth']->id != $vaga->id_empresas) {
    flash()->push('validacoes_login', ['Você não tem permissão para excluir esta vaga.']);
    header('Location: /');
    exit();
}

$database->query(
    sql: "delete from vagas where id = :id",
    params: ['id' => $id_vaga]
);


flash()->push('mensagem', 'Vaga excluída com sucesso!');
header('Location: /');
exit();