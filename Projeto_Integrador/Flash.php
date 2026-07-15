<?php

class Flash
{
    /**
     * Guarda temporariamente um valor na sessão sob uma chave específica.
     * Geralmente usado no Controlador antes de redirecionar o usuário.
     * string $chave O nome identificador da mensagem (ex: 'mensagem' ou 'validacoes')
     * mixed $valor O conteúdo que será guardado (pode ser um texto ou um array de erros)
     */
    public function push($chave, $valor)
    {
        // Salva o valor dentro da superglobal $_SESSION com um prefixo 'flash_' para não misturar com dados de login
        $_SESSION["flash_$chave"] = $valor;
    }

    /**
     * Recupera a mensagem guardada na sessão e a deleta imediatamente em seguida.
     * Geralmente usado na View para exibir o alerta apenas uma vez.
     * string $chave O nome identificador que foi usado para salvar a mensagem
     * mixed Retorna o valor guardado ou 'false' se a mensagem não existir
     */
    public function get($chave)
    {
        // 1. Defesa: Se não existir nenhuma mensagem com essa chave na sessão, retorna 'false'
        if (! isset($_SESSION["flash_$chave"])) {
            return false;
        }

        // 2. Armazena temporariamente o valor em uma variável local antes de apagá-lo da sessão
        $valor = $_SESSION["flash_$chave"];

        // 3. Remove a mensagem da sessão (unset). É isso que garante que a mensagem suma ao recarregar a página!
        unset($_SESSION["flash_$chave"]);

        // 4. Retorna o valor recuperado para que ele possa ser impresso na tela do usuário
        return $valor;
    }
}