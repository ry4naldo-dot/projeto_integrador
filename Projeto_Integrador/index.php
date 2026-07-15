<?php

// 1. CARREGAMENTO DOS MODELOS (Representação das tabelas do banco de dados)
// Importa a classe Usuario para lidar com os dados dos candidatos
require 'models/Usuario.php';

// Importa a classe Empresa para lidar com os dados das empresas
require 'models/Empresa.php';

// Importa a classe Vagas para estruturar e manipular as vagas de emprego
require 'models/Vagas.php';

// Importa a classe Curriculo para estruturar os dados de envio de candidaturas
require 'models/Curriculo.php';

// 2. SISTEMA DE SESSÃO E MENSAGENS RÁPIDAS
// Inicia ou recupera a sessão do usuário no servidor (essencial para logins e persistência de dados)
session_start();

// Importa o sistema de mensagens "Flash" (mensagens temporárias que somem após serem lidas uma vez)
require 'Flash.php';

// 3. FERRAMENTAS E AUXILIARES
// Importa funções globais úteis do projeto (ex: funções como dd(), view(), auth(), etc.)
require 'function.php';

// Importa o validador de formulários que analisa se os inputs do usuário são válidos
require 'Validacao.php';

// 4. BANCO DE DADOS
// Importa as credenciais do banco (driver, host, database, user, etc.) e guarda na variável $config
$config = require 'config.php';

// Abre a conexão com o banco usando a classe DB que você criou e deixa o objeto $database pronto para uso
require 'database.php';

// 5. ROTEAMENTO (O Direcionador)
// Por fim, com todo o sistema preparado, carrega o roteador que vai ler a URL digitada 
// e decidir qual View ou Controlador (Controller) deve ser exibido para o usuário.
require 'route.php';