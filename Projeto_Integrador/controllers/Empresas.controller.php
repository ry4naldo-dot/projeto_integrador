<?php

// Realiza uma consulta para buscar todas as empresas cadastradas no sistema
$empresa = $database->query(
    // A query SQL seleciona absolutamente todas as colunas da tabela 'empresas'
    sql: "select * from empresas",
    // Configura o PDO para transformar automaticamente cada linha retornada em um objeto da classe 'Empresa'
    class: Empresa::class
)->fetchAll(); // O fetchAll() captura todos os registros encontrados e os armazena como um array de objetos


// Carrega a página 'Empresas.view.php' enviando a lista de empresas (variável $empresa) para ser renderizada na tela
view('Empresas', compact('empresa'));