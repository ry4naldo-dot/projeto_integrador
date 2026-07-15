<?php

// 1. PROCESSAMENTO DO FORMULÁRIO (Apenas se a requisição for do tipo POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta as credenciais enviadas pela empresa no formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Executa a validação básica para garantir que o e-mail tem formato correto e a senha foi preenchida
    $validacao = Validacao::validar([
        'email' => ['required', 'email'],
        'senha' => ['required']
    ], $_POST);


    // Se a validação inicial falhar (campos vazios ou e-mail inválido), 
    // redireciona de volta para a tela de login da empresa
    if ($validacao->naoPassou('LoginEmpresa')) {

        header("Location: /LoginEmpresa");
        exit();
    }


    // 2. BUSCA DA EMPRESA NO BANCO DE DADOS
    // Consulta se existe alguma empresa cadastrada com o e-mail fornecido
    $empresa = $database->query(
        sql: "select * from empresas where email = :email",
        class: Empresa::class,
        params: compact('email') // Passa o parâmetro :email de forma segura contra SQL Injection
    )->fetch();


    // 3. VERIFICAÇÃO DE SENHA (Caso a empresa seja encontrada no banco)
    if ($empresa) {

        $senhaDoPost = $_POST['senha'];    // Senha que foi digitada no formulário
        $senhaDoBanco = $empresa->senha;  // Senha (hash ou texto) que está gravada na tabela 'empresas'

        // Compara a senha digitada com a que está salva.
        // Nota: o operador "!" nega apenas o primeiro termo (!$senhaDoPost) na sua lógica original.
        if (!$senhaDoPost == $senhaDoBanco) {

            // Se as senhas não baterem, cria uma mensagem de erro na sessão e redireciona
            flash()->push('validacoes_login', ['Email ou senha estão incorretos']);
            header('Location: /LoginEmpresa');
            exit();
            
        }

        // 4. AUTENTICAÇÃO COM SUCESSO
        // Salva o objeto da empresa na sessão global 'auth' para mantê-la logada no sistema
        $_SESSION['auth'] = $empresa;

        // Cria uma mensagem de boas-vindas na sessão usando o nome da empresa logada
        flash()->push('mensagem', "Seja bem vindo " .  $_SESSION['auth']->nome);

        // Redireciona para a página inicial do painel
        header("Location: /");
        exit();
    }


    // 5. TRATAMENTO DE ERRO (Caso o e-mail da empresa não exista no banco de dados)
    // Define a mensagem genérica de erro para segurança e redireciona de volta ao formulário
    flash()->push('validacoes_login', ['Usuario ou senha estão incorretos']);
    header('Location: /LoginEmpresa');
    exit();
}


// FLUXO DE CARREGAMENTO (GET)
// Se a página for acessada diretamente (via URL), renderiza a View do formulário de login da empresa
view('LoginEmpresa');