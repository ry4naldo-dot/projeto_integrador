<?php

// 1. Defesa Inicial: Se não estiver logado, barra logo de início
if (!auth()) {
    abort(403); // Ou header('Location: /login');
    exit();
}

// ==========================================
// FLUXO 1: Abrir o Formulário de Candidatura (GET)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Pegamos o ID da vaga que veio pela URL (?id=X) para enviar para a view se precisar
    $id_vaga = $_REQUEST['id'] ?? null; 
    
    view('Candidatar', compact('id_vaga')); 
    exit(); // Para a execução aqui para não rodar o código de salvar!
}


// ==========================================
// FLUXO 2: Processar o Envio do Currículo (POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_usuarios     = auth()->id; 
    $id_vagas        = $_POST['id_vagas']; 
    $nome            = $_POST['nome'];
    $email           = $_POST['email'];
    $telefone        = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $tipo            = $_POST['tipo'];
    $descricao       = $_POST['descricao'];

    // Validação
    $validacao = Validacao::validar([
        'nome'            => ['required', 'min:3'],
        'email'           => ['required'],
        'telefone'        => ['required'],
        'data_nascimento' => ['required'],
        'tipo'            => ['required'],
        'descricao'       => ['required', 'min:10']
    ], $_POST);

    if ($validacao->naoPassou()) {
        header("Location: /Vaga?id=$id_vagas");
        exit();
    }

    // Upload do Arquivo
    $img = ""; 
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $nomeNovo = md5(rand());
        $extensao = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $img      = "img/curriculos/$nomeNovo.$extensao";
        move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . "/../$img");
    }

    // Banco de dados
    $database->query(
        sql: "INSERT INTO curriculos (id_usuarios, id_vagas, nome, email, telefone, data_nascimento, tipo, descricao, img) 
              VALUES (:id_usuarios, :id_vagas, :nome, :email, :telefone, :data_nascimento, :tipo, :descricao, :img);",
        params: compact('id_usuarios', 'id_vagas', 'nome', 'email', 'telefone', 'data_nascimento', 'tipo', 'descricao', 'img')
    );

    flash()->push('mensagem', 'Candidatura enviada com sucesso!');
    header("Location: /Vaga?id=$id_vagas");
    exit();
}