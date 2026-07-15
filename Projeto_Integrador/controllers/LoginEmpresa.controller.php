<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta as credenciais enviadas pela empresa no formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Executa a validação básica para garantir que o e-mail tem formato correto e a senha foi preenchida
    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);


    if ($validacao->naoPassou('LoginEmpresa')) {

        header("Location: /LoginEmpresa");
        exit();
    }


    // Consulta se existe alguma empresa cadastrada com o e-mail fornecido
    $empresa = $database->query(
        sql: "select * from empresas where email = :email",
        class: Empresa::class,
        params: compact('email') // Passa o parâmetro :email de forma segura contra SQL Injection
    )->fetch();


    if ($empresa) {

        $senhaDoPost = $_POST['senha'];    
        $senhaDoBanco = $empresa->senha;  

        // Compara a senha digitada com a que está salva.
        if (!$senhaDoPost == $senhaDoBanco) {

            // Se as senhas não baterem, cria uma mensagem de erro na sessão e redireciona
            flash()->push('validacoes_login', ['Email ou senha estão incorretos']);
            header('Location: /LoginEmpresa');
            exit();
            
        }

      
        // Salva o objeto da empresa na sessão global 'auth' para mantê-la logada no sistema
        $_SESSION['auth'] = $empresa;

        // Cria uma mensagem de boas-vindas na sessão usando o nome da empresa logada
        flash()->push('mensagem', "Seja bem vindo " .  $_SESSION['auth']->nome);

        // Redireciona para a página inicial do painel
        header("Location: /");
        exit();
    }


    // Define a mensagem genérica de erro para segurança e redireciona de volta ao formulário
    flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
    header('Location: /LoginEmpresa');
    exit();
}


view('LoginEmpresa');