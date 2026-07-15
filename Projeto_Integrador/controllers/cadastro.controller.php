<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta os dados enviados pelo candidato no formulário de cadastro
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $email_confirmacao = $_POST['email_confirmacao']; 
    $senha = $_POST['senha'];
    $validacao = []; 


    
    // Executa as regras para garantir consistência e segurança nos dados enviados
    $validacao = Validacao::validar([
        'nome'  => ['required'],
        'email' => ['required', 'email', 'unique:usuarios'], 
        'senha' => ['required', 'min:8', 'max:64', 'strong'] 
    ], $_POST);

    // Salva os erros gerados na sessão sob a chave 'validacoes_cadastro'
    if ($validacao->naoPassou('cadastro')) {
        // Redireciona o usuário de volta ao formulário de cadastro
        header('location: /cadastro');
        exit();
    }


    // Executa a query estruturada para salvar o novo candidato na tabela 'usuarios'
    $database->query(
        sql: "insert into usuarios (nome, email, senha) values
(:nome, :email, :senha)",
        params: [
            'nome'  => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
        ]
    );

    // Registra a mensagem temporária de sucesso usando o sistema de Flash
    flash()->push('mensagem', ["Usuario registrado com sucesso!"]);
    
    // Redireciona o novo usuário cadastrado para a tela de login
    header('Location: /login');
    exit;
}

view('cadastro');