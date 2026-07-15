<?php

// 1. CAPTURA DOS PARÂMETROS DE BUSCA
// Lê o termo digitado na barra de pesquisa usando $_REQUEST (aceita GET ou POST). Se não houver nada, define como string vazia.
$pesquisar = $_REQUEST['pesquisar'] ?? '';

// Lê o modelo de trabalho selecionado no filtro lateral (remoto, presencial, hibrido). Se não houver nada, define como vazio.
$modelo    = $_REQUEST['modelo'] ?? '';


// 2. SQL BASE (Sem filtros)
// Estrutura a query inicial que busca os dados das vagas e faz a junção (INNER JOIN) com a tabela de empresas 
// para trazer informações extras como o nome da empresa e o endereço.
$sql = "SELECT 
            v.id,
            e.nome_empresa, 
            v.descricao, 
            v.tipo, 
            v.valor, 
            v.modelo,
            e.endereco  
          FROM vagas v
          INNER JOIN empresas e ON v.id_empresas = e.id";

// Criamos duas listas vazias que serão preenchidas de acordo com o que o usuário escolheu na tela:
$condicoes = []; // Guardará os pedaços de código SQL (ex: "v.modelo = :modelo")
$params = [];    // Guardará os valores reais de forma protegida para o PDO (ex: ['modelo' => 'remoto'])


// 3. FILTRO POR TERMO DE PESQUISA (Se preenchido pelo usuário)
if (!empty($pesquisar)) {
    // Adiciona o teste de busca parcial (LIKE) na descrição da vaga ou no nome da empresa à lista de condições
    $condicoes[] = "(v.descricao LIKE :pesquisar OR e.nome_empresa LIKE :pesquisar)";
    
    // Associa o token ':pesquisar' ao valor digitado envolvido por símbolos de porcentagem (%) para buscar correspondências parciais
    $params['pesquisar'] = "%$pesquisar%";
}


// 4. FILTRO POR MODELO DE TRABALHO (Se selecionado pelo usuário)
if (!empty($modelo)) {
    // Adiciona o teste exato de igualdade da coluna 'modelo' à lista de condições
    $condicoes[] = "v.modelo = :modelo";
    
    // Associa o token ':modelo' ao valor capturado do filtro
    $params['modelo'] = $modelo;
}


// 5. MONTAGEM DINÂMICA DA CLÁUSULA WHERE
// Se o array de condições tiver pelo menos um item (ou seja, o usuário pesquisou ou filtrou alguma coisa):
if (count($condicoes) > 0) {
    // Junta todos os pedaços do array de condições adicionando um " AND " entre eles e concatena no final do SQL Base.
    // Ex de resultado: "... INNER JOIN empresas e ON v.id_empresas = e.id WHERE v.modelo = :modelo"
    $sql .= " WHERE " . implode(" AND ", $condicoes);
}


// 6. EXECUÇÃO DA CONSULTA NO BANCO DE DADOS
// Envia a query final estruturada, a classe de mapeamento de objetos (Vagas) e os parâmetros de segurança para o motor do banco
$VagasRecentes = $database->query(
    sql: $sql,
    class: Vagas::class,
    params: $params
)->fetchAll(); // Captura todas as linhas encontradas e armazena em um array


// 7. RENDERIZAÇÃO DA VIEW
// Envia a lista filtrada de vagas para a página HTML do painel inicial
view('index', compact('VagasRecentes'));