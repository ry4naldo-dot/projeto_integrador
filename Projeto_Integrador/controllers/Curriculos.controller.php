<?php

// Recupera o ID da empresa que está atualmente logada no sistema através da sessão global (função auth())
$id_empresa = auth()->id;


// Busca apenas os currículos das vagas criadas especificamente pela empresa logada
$curriculo = $database->query(
    sql: "select * from curriculos c
    inner join vagas as v on c.id_vagas = v.id
    where v.id_empresas = :id_empresa",
    
    // Transforma cada linha encontrada do banco de dados em um objeto estruturado da classe 'Curriculo'
    class: Curriculo::class,
    
    // Passa o ID da empresa logada de forma segura para substituir o marcador ':id_empresa'
    params: ['id_empresa' => $id_empresa]
)->fetchAll(); 

// Abre a tela de currículos ('Curriculos.view.php') enviando a lista filtrada de candidatos ($curriculo)
view('Curriculos', compact('curriculo'));