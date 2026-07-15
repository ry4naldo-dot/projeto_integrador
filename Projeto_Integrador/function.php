<?php

/**
 * Carrega uma View (página HTML) e extrai variáveis para serem usadas nela.
 * string $view O nome do arquivo da view (ex: 'index' ou 'CadastroEmpresa')
 * array $data Um array associativo de dados que serão injetados na tela (ex: ['vagas' => $vagas])
 */
function view($view, $data = [])
{
    // O PHP varre o array de dados e transforma suas chaves em variáveis reais.
    // Se você passou ['vagas' => $vagas], a linha "$$key = $value" cria a variável $vagas automaticamente na view.
    foreach ($data as $key => $value) {
        $$key = $value; // O uso de "$$" chama-se variável dinâmica (ou variável variável) no PHP
    }

    // Carrega o layout padrão (template/estrutura) que envelopa e renderiza a view correspondente
    require "view/template/app.php";
}

/**
 * Função utilitária para debugar o código (Dump and Die).
 * Mostra de forma organizada o conteúdo de uma ou mais variáveis e para a execução do script.
 * mixed ...$dump Aceita múltiplas variáveis para depurar ao mesmo tempo
 */
function dd(...$dump)
{
    echo "<pre style='background: #111; color: #5af75a; padding: 15px; border-radius: 5px;'>";
    // Exibe a estrutura completa da variável (tipos, tamanhos e valores)
    var_dump($dump);
    echo "</pre>";
    die(); // Interrompe imediatamente a execução do PHP
}

/**
 * Aborta a navegação atual definindo um código de status HTTP e exibindo uma view de erro.
 * Geralmente usado para erros de Acesso Negado (403) ou Página Não Encontrada (404).
 * * @param int $code O código de erro HTTP (ex: 403, 404, 500)
 */
function abort($code)
{
    http_response_code($code); // Altera o cabeçalho do navegador para o status do erro
    view($code); // Tenta carregar uma view com o nome do erro (ex: view/404.view.php)
    die(); // Para o fluxo
}

/**
 * Atalho rápido (Helper) para instanciar e usar a classe Flash sem precisar digitar "new Flash".
 *  Flash Retorna um novo objeto da classe Flash
 */
function flash()
{
    return new flash;
}

/**
 * Helper para carregar as configurações do sistema de forma rápida.
 *  string|null $chave Se informada, traz apenas aquela configuração (ex: config('database'))
 *  mixed Retorna o array inteiro ou apenas o valor da chave solicitada
 */
function config($chave = null)
{
    // Lê o arquivo de configuração
    $config = require 'config.php';

    // Se o desenvolvedor pediu uma chave específica, retorna só ela
    if (strlen($chave) > 0) {
        return $config[$chave];
    }

    // Caso contrário, retorna todas as configurações
    return $config;
}

/**
 * Verifica se existe um usuário comum ou empresa logada no sistema.
 * mixed Retorna o objeto do usuário logado se ele existir, ou null se ninguém estiver logado
 */
function auth()
{
    // Se a chave 'auth' não existir na sessão do navegador, ninguém está logado
    if (!isset($_SESSION['auth'])) {
        return null;
    }

    // Se existir, retorna os dados da sessão (geralmente um objeto/array com id, nome, e-mail, etc.)
    return $_SESSION['auth'];
}
