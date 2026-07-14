<?php

// 1. Defesa Inicial: Se não estiver logado, não faz nada e expulsa
if (!auth()) {
    header('Location: /');
    exit();
}

// ==========================================
// FLUXO 1: Apenas exibir o formulário (GET)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    view('InserirVaga'); // Carrega a sua view com o formulário HTML
    exit(); // Para a execução aqui para não tentar salvar no banco!
}


// ==========================================
// FLUXO 2: Processar o envio dos dados (POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_empresas = auth()->id;
    $descricao   = $_POST['descricao'];
    $tipo        = $_POST['tipo'];
    $valor       = $_POST['valor'];
    $modelo      = $_POST['modelo'];

    // Validação
    $validacao = Validacao::validar([
        'descricao' => ['required', 'min:10'],
        'tipo'      => ['required'],
        'valor'     => ['required'],
        'modelo'    => ['required'],
    ], $_POST);

    if ($validacao->naoPassou()) {
        // Se der erro, recarrega a mesma página do formulário
        header('Location: /InserirVaga');
        exit();
    }

    // Insere no banco
    $database->query(
        sql: "INSERT INTO vagas (id_empresas, descricao, tipo, valor, modelo)
              VALUES (:id_empresas, :descricao, :tipo, :valor, :modelo);",
        params: compact('id_empresas', 'descricao', 'tipo', 'valor', 'modelo')
    );

    flash()->push('mensagem', 'Vaga publicada com sucesso!');

    // Redireciona para o index após salvar com sucesso
    header('Location: /');
    exit();
}