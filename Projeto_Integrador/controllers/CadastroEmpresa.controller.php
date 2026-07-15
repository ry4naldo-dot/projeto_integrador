<?php

// 1. PROCESSAMENTO DO FORMULÁRIO (Apenas se a requisição for do tipo POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Coleta as informações de cadastro enviadas pela empresa no formulário
    $nome_empresa = $_POST['nome_empresa'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['tipo']; // Tipo de empresa ou segmento de atuação
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao']; // Breve resumo ou biografia da empresa
    $validacao = []; // Inicializa a variável como um array vazio (ela será sobrescrevida pelo validador abaixo)

    // 2. VALIDAÇÃO DOS CAMPOS
    // Define as regras de validação para cada campo do formulário de cadastro
    $validacao = Validacao::validar([
        'nome_empresa' => ['required'],
        'email'        => ['required', 'email', 'unique:empresas'], // Garante que o e-mail seja válido e único na tabela 'empresas'
        'senha'        => ['required', 'min:6', 'max:64'], // Senha deve ter entre 6 e 64 caracteres
        'telefone'     => ['required'],
        'tipo'         => ['required'],
        'endereco'     => ['required']
    ], $_POST);


    // Se o validador encontrar problemas (como um e-mail já cadastrado ou senha curta):
    // Salva as mensagens de erro na sessão com o nome customizado 'validacoes_registro'
    if ($validacao->naoPassou('validacoes_registro')) {
        // Redireciona de volta para a página de formulário de cadastro
        header('location: /CadastroEmpresa');
        exit();
    }


    // 3. SALVAMENTO NO BANCO DE DADOS
    // Executa a query para cadastrar a nova empresa na tabela correspondente
    $database->query(
        sql: "INSERT INTO empresas (nome_empresa, email, senha, numero, tipo, endereco, descricao) 
              VALUES (:nome_empresa, :email, :senha, :numero, :tipo, :endereco, :descricao)",
        
        // Passa os parâmetros de forma segura para substituir os placeholders
        params: [
            'nome_empresa' => $nome_empresa,
            'email'        => $email,
            // Criptografa a senha do usuário utilizando o algoritmo padrão do PHP (BCRYPT) por questões de segurança
            'senha'        => password_hash($senha, PASSWORD_DEFAULT), 
            'numero'       => $telefone, // Associa o dado 'telefone' à coluna 'numero' do banco de dados
            'tipo'         => $tipo,
            'endereco'     => $endereco,
            'descricao'    => $descricao
        ]
    );

    // 4. FEEDBACK E DIRECIONAMENTO
    // Cria uma mensagem de sucesso na sessão para ser exibida na tela de destino
    flash()->push('mensagem', ["Empresa registrada com sucesso!"]);
    
    // Redireciona a nova empresa para a tela de login
    header('Location: /LoginEmpresa');
    exit;
}


// FLUXO DE CARREGAMENTO (GET)
// Se a página for acessada via URL comum, carrega a View que exibe o formulário de cadastro
view('CadastroEmpresa');