<?php


// Exibe a página que contém o formulário HTML para o cadastro da vaga.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    view('InserirVaga');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Coleta as informações enviadas pelo formulário
    $id_empresas = auth()->id; // Recupera o ID da empresa logada que está salva na sessão
    $descricao   = $_POST['descricao'];
    $tipo        = $_POST['tipo'];
    $valor       = $_POST['valor'];
    $modelo      = $_POST['modelo'];

    // Garante que todos os campos foram preenchidos e que a descrição possui um tamanho mínimo aceitável
    $validacao = Validacao::validar([
        'descricao' => ['required', 'min:10'], // Descrição é obrigatória e precisa de pelo menos 10 caracteres     
        'tipo'      => ['required'],
        'valor'     => ['required'],
        'modelo'    => ['required'],
    ], $_POST);

    // Se a validação encontrar erros, redireciona o usuário de volta ao formulário
    if ($validacao->naoPassou()) {
        // Se der erro, recarrega a mesma página do formulário
        header('Location: /InserirVaga');
        exit();
    }

    // Executa a query estruturada para salvar a nova vaga na tabela 'vagas'
    $database->query(
        sql: "INSERT INTO vagas (id_empresas, descricao, tipo, valor, modelo)
              VALUES (:id_empresas, :descricao, :tipo, :valor, :modelo);",

        // O compact() cria o array substituindo de forma automática os tokens (ex: ':descricao')
        // pelas variáveis de mesmo nome correspondente ($descricao)
        params: compact('id_empresas', 'descricao', 'tipo', 'valor', 'modelo')
    );

    // Define uma mensagem de sucesso temporária na sessão utilizando o sistema de Flash
    flash()->push('mensagem', 'Vaga publicada com sucesso!');

    // Redireciona para o painel principal do index após salvar com sucesso
    header('Location: /');
    exit();
}
