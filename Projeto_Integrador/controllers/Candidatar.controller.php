<?php

// Se não houver nenhum usuário ou empresa logada na sessão (auth() retorna null),
// barra imediatamente a navegação e redireciona para a tela de login.
if (!auth()) {
    header('Location: /login');
    exit();
}

// Captura o ID da vaga que veio na query string da URL (ex: ?id=5).
$id_vaga = $_REQUEST['id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Coleta as credenciais e dados pessoais preenchidos no formulário
    $id_usuarios     = auth()->id;
    $id_vagas        = $_POST['id_vagas']; 
    $nome            = $_POST['nome'];
    $email           = $_POST['email'];
    $telefone        = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $tipo            = $_POST['tipo']; 
    $descricao       = $_POST['descricao']; 

    // Garante o preenchimento de todas as informações básicas obrigatórias
    $validacao = Validacao::validar([
        'nome'            => ['required', 'min:3'], 
        'email'           => ['required'],
        'telefone'        => ['required'],
        'data_nascimento' => ['required'],
        'tipo'            => ['required'],
        'descricao'       => ['required', 'min:10']
    ], $_POST);

    // Se o validador encontrar inconsistências ou campos vazios:
    if ($validacao->naoPassou()) {
        // Redireciona o usuário de volta à página de detalhes da vaga correspondente
        header("Location: /Vaga?id=$id_vagas");
        exit();
    }

    
    $img = ""; // Variável padrão para persistir o caminho no banco de dados (caso nenhum arquivo seja enviado)
    
    // Verifica se o arquivo chamado 'img' foi enviado sem erros no upload (UPLOAD_ERR_OK)
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // Gera uma sequência de hash única e aleatória usando md5() e rand() para evitar conflitos de nomes iguais de arquivos no servidor
        $nomeNovo = md5(rand());
        
        // Isola a extensão original do arquivo (ex: 'pdf', 'jpg', 'png')
        $extensao = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        
        // Define o caminho relativo final onde o arquivo será salvo publicamente no projeto
        $img      = "img/curriculos/$nomeNovo.$extensao";
        
        // Move o arquivo temporário gerado pelo PHP (tmp_name) para a pasta física final no servidor (__DIR__ representa o diretório atual do controller)
        move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . "/../$img");
    }

   
    // Executa a query de inserção para cadastrar a nova candidatura (currículo) associando-a ao usuário e à vaga
    $database->query(
        sql: "INSERT INTO curriculos (id_usuarios, id_vagas, nome, email, telefone, data_nascimento, tipo, descricao, img) 
              VALUES (:id_usuarios, :id_vagas, :nome, :email, :telefone, :data_nascimento, :tipo, :descricao, :img);",
        
        // Monta o array associativo unindo todas as variáveis para substituir os parâmetros :placeholders de forma segura contra SQL Injection
        params: compact('id_usuarios', 'id_vagas', 'nome', 'email', 'telefone', 'data_nascimento', 'tipo', 'descricao', 'img')
    );
    
    // Salva uma mensagem temporária de sucesso na sessão do usuário
    flash()->push('mensagem', 'Candidatura enviada com sucesso!');
    
    // Redireciona para a página de detalhes da vaga que ele acabou de se candidatar
    header("Location: /Vaga?id=$id_vagas");
    exit();
}

view('Candidatar', compact('id_vaga')); 