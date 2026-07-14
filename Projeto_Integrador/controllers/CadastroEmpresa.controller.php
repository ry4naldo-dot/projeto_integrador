<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome_empresa = $_POST['nome_empresa'];
    $email = $_POST['email'];
    // $email_confirmacao = $_POST['email_confirmacao'];
    $senha = $_POST['senha'];
    $validacao = [];


    $validacao = Validacao::validar([
        'nome_empresa' => ['required'],
        'email' => ['required', 'email', 'unique:usuarios'],
        'senha' => ['required', 'min:8', 'max:64', 'strong']
    ], $_POST);


    if ($validacao->naoPassou('CadastroEmpresa')) {
        header('location: /CadastroEmpresa');
        exit();
    }



    $database->query(
        sql: "insert into empresas (nome_empresa, email, senha) values
(:nome_empresa, :email, :senha)",
        params: [
            'nome_empresa' => $_POST['nome_empresa'],
            'email' => $_POST['email'],
            'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
        ]
    );

    flash()->push('mensagem', ["Empresa registrada com sucesso!"]);
    header('Location: /LoginEmpresa');
    exit;
}

view('CadastroEmpresa');