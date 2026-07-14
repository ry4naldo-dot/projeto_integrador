<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);


    if ($validacao->naoPassou('LoginEmpresa')) {

        header("Location: /LoginEmpresa");
        exit();
    }


    $empresa = $database->query(
        sql: "select * from empresas where email = :email",
        class: Empresa::class,
        params: compact('email')
    )->fetch();


    if ($empresa) {

        $senhaDoPost = $_POST['senha'];

        $senhaDoBanco = $empresa->senha;

        if (!$senhaDoPost == $senhaDoBanco) {


            flash()->push('validacoes_login', ['Email ou senha estão incorretos']);
            header('Location: /LoginEmpresa');
            exit();
            
        }

        $_SESSION['auth'] = $empresa;

        flash()->push('mensagem', "Seja bem vindo " .  $_SESSION['auth']->nome);

        header("Location: /");
        exit();
    }

    dd($empresa);

    flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
    header('Location: /LoginEmpresa');
    exit();
}


view('LoginEmpresa');
