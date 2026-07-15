<?php

// 1. CAPTURA DO IDENTIFICADOR
// Recupera o ID da empresa que está atualmente logada no sistema através da sessão global (função auth())
$id_empresa = auth()->id;


// 2. EXECUÇÃO DA CONSULTA FILTRADA NO BANCO DE DADOS
// Busca apenas os currículos das vagas criadas especificamente pela empresa logada
$curriculo = $database->query(
    // A query utiliza um INNER JOIN para ligar a tabela de 'curriculos' (c) com a de 'vagas' (v)
    // através do ID da vaga (id_vagas). O filtro 'WHERE' garante que só retornem vagas cujo 'id_empresas' 
    // seja igual ao ID da empresa que está navegando no momento.
    sql: "select * from curriculos c
    inner join vagas as v on c.id_vagas = v.id
    where v.id_empresas = :id_empresa",
    
    // Transforma cada linha encontrada do banco de dados em um objeto estruturado da classe 'Curriculo'
    class: Curriculo::class,
    
    // Passa o ID da empresa logada de forma segura para substituir o marcador ':id_empresa'
    params: ['id_empresa' => $id_empresa]
)->fetchAll(); // Captura todos os resultados encontrados que passaram no filtro


// 3. RENDERIZAÇÃO DA VIEW
// Abre a tela de currículos ('Curriculos.view.php') enviando a lista filtrada de candidatos ($curriculo)
view('Curriculos', compact('curriculo'));