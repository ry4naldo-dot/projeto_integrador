<?php

// 1. EXECUÇÃO DA CONSULTA NO BANCO DE DADOS
// Busca as informações de uma vaga específica através do parâmetro 'id' enviado pela URL ($_REQUEST['id'])
$vagas = $database->query(
    // A query seleciona todas as colunas da vaga (v.*) e também o nome da empresa correspondente (e.nome_empresa)
    sql: "SELECT 
            v.*, 
            e.nome_empresa 
          FROM vagas v
          INNER JOIN empresas e ON v.id_empresas = e.id
          WHERE v.id = :id",
    
    // Mapeia o resultado diretamente para um objeto da classe 'Vagas'
    class: Vagas::class,
    
    // Passa o ID coletado da requisição para o parâmetro ':id' de forma segura contra SQL Injection
    params: ['id' => $_REQUEST['id']]
)->fetch(); // fetch() busca apenas uma linha de resultado (já que o ID é único)


// 2. RENDERIZAÇÃO DA VIEW
// Carrega a página 'Vaga.view.php' passando o objeto da vaga encontrada para ser exibido na tela
view('Vaga', compact('vagas'));