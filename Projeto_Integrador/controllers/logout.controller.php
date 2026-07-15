<?php

// Destrói completamente todos os dados associados à sessão ativa do usuário/empresa.
session_destroy();

// Envia um cabeçalho HTTP para o navegador instruindo-o a redirecionar o usuário para a página de login.
header("Location: /login");

// Interrompe imediatamente a execução de qualquer código php
exit();