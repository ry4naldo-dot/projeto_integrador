<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta as informações de cadastro enviadas pela empresa no formulário
    $nome_empresa = $_POST['nome_empresa'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];
    $validacao = [];

    // Define as regras de validação para cada campo do formulário de cadastro
    $validacao = Validacao::validar([
        'nome_empresa' => ['required'],
        'email'        => ['required', 'email', 'unique:empresas'],
        'senha'        => ['required', 'min:6', 'max:64'],
        'telefone'     => ['required'],
        'tipo'         => ['required'],
        'endereco'     => ['required']
    ], $_POST);


    // Se o validador encontrar problemas (como um e-mail já cadastrado ou senha curta):
    // Salva as mensagens de erro na sessão com o nome customizado 'validacoes_registro'
    if ($validacao->naoPassou('validacoes_registro')) {
        // Redireciona de volta para a página de formulário de cadastro
        header('location: /CadastroEmpresa');
        exit();
    }


    // Executa a query para cadastrar a nova empresa na tabela correspondente
    $database->query(
        sql: "insert into empresas (nome_empresa, email, senha, numero, tipo, endereco, descricao) 
              values (:nome_empresa, :email, :senha, :numero, :tipo, :endereco, :descricao)",
        params: [
            'nome_empresa' => $nome_empresa,
            'email'        => $email,
            'senha'        => password_hash($senha, PASSWORD_DEFAULT),
            'numero'       => $telefone,
            'tipo'         => $tipo,
            'endereco'     => $endereco,
            'descricao'    => $descricao
        ]
    );

    // Cria uma mensagem de sucesso na sessão para ser exibida na tela de destino
    flash()->push('mensagem', ["Empresa registrada com sucesso!"]);

    // Redireciona a nova empresa para a tela de login
    header('Location: /LoginEmpresa');
    exit;
}


view('CadastroEmpresa');
