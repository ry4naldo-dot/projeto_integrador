<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);


    if ($validacao->naoPassou('login')) {

        header("Location: /login");
        exit();
    }


    $usuario = $database->query(
        sql: "select * from usuarios where email = :email",
        class: Usuario::class,
        params: compact('email')
    )->fetch();


    if ($usuario) {

        $senhaDoPost = $_POST['senha'];

        $senhaDoBanco = $usuario->senha;

        if (!$senhaDoPost == $senhaDoBanco) {

         
            flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
            header('Location: /login');
            exit();
        }

        $_SESSION['auth'] = $usuario;

        flash()->push('mensagem', "Seja bem vindo " .  $_SESSION['auth']->nome);

        header("Location: /");
        exit();
    }

  
    flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
    header('Location: /login');
    exit();
}


view('login');
