<?php

// 1. DESTRUIÇÃO DA SESSÃO ATUAL
// Destrói completamente todos os dados associados à sessão ativa do usuário/empresa.
// Isso limpa as variáveis globais (como $_SESSION['auth'] ou $_SESSION['adm']), desconectando-os do sistema.
session_destroy();

// 2. REDIRECIONAMENTO
// Envia um cabeçalho HTTP para o navegador instruindo-o a redirecionar o usuário para a página de login.
header("Location: /login");

// 3. INTERRUPÇÃO DO SCRIPT
// Interrompe imediatamente a execução de qualquer código PHP subsequente por motivos de segurança.
exit();