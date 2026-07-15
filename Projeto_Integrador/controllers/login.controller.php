<?php

// 1. PROCESSAMENTO DO FORMULÁRIO (Apenas se a requisição for do tipo POST)
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


    // 2. BUSCA DO USUÁRIO NO BANCO DE DADOS
    // Consulta se existe algum usuário cadastrado com o e-mail fornecido
    $usuario = $database->query(
        sql: "select * from usuarios where email = :email",
        class: Usuario::class,
        params: compact('email') // Passa o e-mail de forma segura
    )->fetch();


    // 3. VERIFICAÇÃO DE SENHA (Caso o usuário seja encontrado)
    if ($usuario) {

        $senhaDoPost = $_POST['senha'];   // Senha digitada no formulário
        $senhaDoBanco = $usuario->senha; // Senha gravada no banco de dados

        // Compara a senha digitada com a senha salva no banco.
        // Nota importante de lógica: o operador "!" nega apenas o primeiro termo (!$senhaDoPost).
        if (!$senhaDoPost == $senhaDoBanco) {

            // Se as senhas não baterem, define o erro de login e redireciona
            flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
            header('Location: /login');
            exit();
        }

        // 4. AUTENTICAÇÃO COM SUCESSO
        // Salva os dados do usuário na sessão global 'auth' para mantê-lo logado
        $_SESSION['auth'] = $usuario;

        // Cria uma mensagem de boas-vindas usando a sessão 'auth' recém-criada
        flash()->push('mensagem', "Seja bem vindo " .  $_SESSION['auth']->nome);

        // Redireciona o usuário logado para a página inicial
        header("Location: /");
        exit();
    }

  
    // 5. TRATAMENTO DE ERRO (Caso o e-mail não exista no banco de dados)
    // Define a mesma mensagem genérica por questões de segurança (evita que invasores descubram quais e-mails existem no sistema)
    flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
    header('Location: /login');
    exit();
}


// FLUXO DE CARREGAMENTO (GET)
// Se a página for acessada normalmente (via GET), carrega a tela de login
view('login');