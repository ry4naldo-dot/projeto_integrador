<?php

$vagas = $database->query(
    sql: "select
            v.*, 
            e.nome_empresa 
          from vagas v
          inner join empresas e on v.id_empresas = e.id
          where v.id = :id",
    class: Vagas::class,
    params: ['id' => $_REQUEST['id']]
)->fetch(); 


// Carrega a página 'Vaga.view.php' passando o objeto da vaga encontrada para ser exibido na tela
view('Vaga', compact('vagas'));