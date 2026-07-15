<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome_empresa = $_POST['nome_empresa'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];
    $validacao = [];

    $validacao = Validacao::validar([
        'nome_empresa' => ['required'],
        'email'        => ['required', 'email', 'unique:empresas'],
        'senha'        => ['required', 'min:6', 'max:64'], 
        'telefone'     => ['required'],
        'tipo'         => ['required'],
        'endereco'     => ['required']
    ], $_POST);


    if ($validacao->naoPassou('validacoes_registro')) {
        header('location: /CadastroEmpresa');
        exit();
    }



    $database->query(
        sql: "INSERT INTO empresas (nome_empresa, email, senha, numero, tipo, endereco, descricao) 
              VALUES (:nome_empresa, :email, :senha, :numero, :tipo, :endereco, :descricao)",
        params: [
            'nome_empresa' => $nome_empresa,
            'email'        => $email,
            'senha'        => password_hash($senha, PASSWORD_DEFAULT), 
            'numero'     => $telefone,
            'tipo'         => $tipo,
            'endereco'     => $endereco,
            'descricao'    => $descricao
        ]
    );

    flash()->push('mensagem', ["Empresa registrada com sucesso!"]);
    header('Location: /LoginEmpresa');
    exit;
}

view('CadastroEmpresa');