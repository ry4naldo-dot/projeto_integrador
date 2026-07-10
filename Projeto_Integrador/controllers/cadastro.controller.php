<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $email_confirmacao = $_POST['email_confirmacao'];
    $senha = $_POST['senha'];
    $validacao = [];


    $validacao = Validacao::validar([
        'nome' => ['required'],
        'email' => ['required', 'email', 'unique:usuarios'],
        'senha' => ['required', 'min:8', 'max:64', 'strong']
    ], $_POST);


    if ($validacao->naoPassou('cadastro')) {
        header('location: /cadastro');
        exit();
    }



    $database->query(
        sql: "insert into usuarios (nome, email, senha) values
(:nome, :email, :senha)",
        params: [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
        ]
    );

    flash()->push('mensagem', ["Usuario registrado com sucesso!"]);
    header('Location: /login');
    exit;
}


// header('Location: /cadastro');
view('cadastro');