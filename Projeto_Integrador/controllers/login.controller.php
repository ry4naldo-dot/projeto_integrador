<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta as credenciais enviadas pelo usuário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Executa a validação básica para garantir que o e-mail é válido e ambos os campos foram preenchidos
    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);


    // Se a validação inicial falhar, redireciona o usuário de volta para a tela de login
    if ($validacao->naoPassou('login')) {

        header("Location: /login");
        exit();
    }


    // Consulta se existe algum usuário cadastrado com o e-mail fornecido
    $usuario = $database->query(
        sql: "select * from usuarios where email = :email",
        class: Usuario::class,
        params: compact('email') // Passa o e-mail de forma segura
    )->fetch();


    if ($usuario) {

        $senhaDoPost = $_POST['senha'];   
        $senhaDoBanco = $usuario->senha; 

        // Compara a senha digitada com a senha salva no banco.
        if (!$senhaDoPost == $senhaDoBanco) {

            // Se as senhas não baterem, define o erro de login e redireciona
            flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
            header('Location: /login');
            exit();
        }

        // Salva os dados do usuário na sessão global 'auth' para mantê-lo logado
        $_SESSION['auth'] = $usuario;

        // Cria uma mensagem de boas-vindas usando a sessão 'auth' recém-criada
        flash()->push('mensagem', "Seja bem vindo " .  $_SESSION['auth']->nome);

        // Redireciona o usuário logado para a página inicial
        header("Location: /");
        exit();
    }

  
    // Define a mesma mensagem genérica por questões de segurança
    flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
    header('Location: /login');
    exit();
}

view('login');