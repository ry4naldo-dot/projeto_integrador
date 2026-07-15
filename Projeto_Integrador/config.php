<?php
// Retorna um array de configuração para que possa ser importado por outros arquivos (ex: $config = require 'config.php')
return [
    // Chave principal que agrupa as configurações da conexão
    'database' => [
        // O driver de banco de dados que o PDO vai utilizar (no seu caso, MySQL)
        'driver'   => 'mysql',  
        // O endereço onde o servidor do banco de dados está rodando (localhost significa a sua própria máquina)
        'host'     => 'localhost',     
        // A porta padrão de comunicação do MySQL (3306 é o padrão mundial para o MySQL)
        'port'     => '3306',   
        // O nome do banco de dados que você criou no MySQL para este projeto
        'database' => 'ClickVagas', 
        // O usuário administrador do banco de dados (no ambiente de desenvolvimento local, o padrão quase sempre é 'root')
        'user'     => 'root',        
        // O conjunto de caracteres (charset) utilizado para suportar acentuação, caracteres especiais e até emojis no banco de dados
        'charset'  => 'utf8mb4'
    ]
];