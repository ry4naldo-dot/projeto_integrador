<?php

// 1. PROCESSAMENTO DO FORMULÁRIO (Apenas se a requisição for do tipo POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta os dados enviados pelo candidato no formulário de cadastro
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $email_confirmacao = $_POST['email_confirmacao']; // Campo coletado para possível verificação
    $senha = $_POST['senha'];
    $validacao = []; // Inicializa a variável como um array vazio (ela será sobrescrita pelo validador abaixo)


    // 2. VALIDAÇÃO DOS CAMPOS
    // Executa as regras para garantir consistência e segurança nos dados enviados
    $validacao = Validacao::validar([
        'nome'  => ['required'],
        'email' => ['required', 'email', 'unique:usuarios'], // E-mail obrigatório, em formato válido e exclusivo na tabela 'usuarios'
        'senha' => ['required', 'min:8', 'max:64', 'strong'] // Senha forte (com caracteres especiais) entre 8 e 64 caracteres
    ], $_POST);


    // Se o validador encontrar problemas (como um e-mail duplicado ou senha fraca):
    // Salva os erros gerados na sessão sob a chave 'validacoes_cadastro'
    if ($validacao->naoPassou('cadastro')) {
        // Redireciona o usuário de volta ao formulário de cadastro
        header('location: /cadastro');
        exit();
    }


    // 3. PERSISTÊNCIA NO BANCO DE DADOS
    // Executa a query estruturada para salvar o novo candidato na tabela 'usuarios'
    $database->query(
        sql: "insert into usuarios (nome, email, senha) values
(:nome, :email, :senha)",
        
        // Passa os parâmetros higienizados diretamente para evitar ataques de SQL Injection
        params: [
            'nome'  => $_POST['nome'],
            'email' => $_POST['email'],
            // Criptografa a senha com o algoritmo padrão do PHP (BCRYPT) para salvar de forma segura no banco
            'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
        ]
    );

    // 4. FEEDBACK E DIRECIONAMENTO
    // Registra a mensagem temporária de sucesso usando o sistema de Flash
    flash()->push('mensagem', ["Usuario registrado com sucesso!"]);
    
    // Redireciona o novo usuário cadastrado para a tela de login
    header('Location: /login');
    exit;
}


// FLUXO DE CARREGAMENTO (GET)
// Se a página for acessada normalmente por URL, renderiza a View que exibe o formulário de cadastro
view('cadastro');