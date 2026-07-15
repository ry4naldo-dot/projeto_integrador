<?php

class Validacao
{
    // Armazena a lista com todas as mensagens de erro geradas durante a validação
    public $validacoes = [];

    /**
     * Método principal (estático) que inicia o processo de validação.
     * Recebe as regras definidas (ex: 'required', 'min:6') e os dados enviados pelo formulário ($_POST).
     */
    public static function validar($regras, $dados)
    {
        // Instancia a própria classe de validação para podermos usar os métodos internos não-estáticos
        $validacao = new self;

        // Varre cada campo que possui regras definidas no controlador
        foreach ($regras as $campo => $regrasDoCampo) {

            // Varre cada uma das regras aplicadas a este campo específico (ex: roda 'required', depois 'email')
            foreach ($regrasDoCampo as $regra) {
                
                // Captura o valor que o usuário digitou para o campo atual
                $valorDocampo = $dados[$campo];

                // CASO 1: A regra é de confirmação (ex: senha_confirmacao)
                if ($regra == 'confirmed') {
                    // Chama o método "confirmed" passando o nome do campo, o valor digitado e o valor do campo de confirmação
                    $validacao->$regra($campo, $valorDocampo, $dados["{$campo}_confirmacao"]);
                    
                } 
                // CASO 2: A regra possui parâmetros separados por dois pontos (ex: "min:8" ou "unique:empresas")
                else if (str_contains($regra, ':')) {

                    // Divide a string nos dois pontos. Ex: "unique:empresas" vira ['unique', 'empresas']
                    $temp = explode(':', $regra);
                    $regra = $temp[0];    // A função a ser executada (ex: 'unique')
                    $regraAr = $temp[1];  // O parâmetro extra (ex: a tabela 'empresas' ou número mínimo '8')

                    // Executa dinamicamente o método correspondente passando o parâmetro extra
                    $validacao->$regra($campo, $regraAr, $valorDocampo);
                } 
                // CASO 3: É uma regra simples sem parâmetros (ex: 'required', 'email', 'strong')
                else {
                    // Executa o método de validação correspondente ao nome da regra
                    $validacao->$regra($campo, $valorDocampo);
                }
            }
        }

        // Retorna o objeto de validação completo (que agora contém ou não erros dentro de $this->validacoes)
        return $validacao;
    }

    /**
     * Valida se o campo obrigatório foi preenchido.
     */
    private function required($campo, $valor)
    {
        // Se o tamanho da string for 0, significa que o usuário deixou o campo vazio
        if (strlen($valor) == 0) {
            $this->validacoes[] = "O $campo é obrigatorio!";
        }
    }

    /**
     * Valida se o formato do e-mail é válido utilizando filtros nativos do PHP.
     */
    private function email($campo, $valor)
    {
        // filter_var retorna 'false' se o e-mail não estiver em um formato válido (ex: sem o @ ou .com)
        if (! filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->validacoes[] = "O $campo deve ser um $campo valido!";
        }
    }

    /**
     * Valida se o valor digitado é idêntico ao campo de confirmação.
     */
    private function confirmed($campo, $valor, $confirmed)
    {
        // Se o valor principal for diferente do campo de confirmação, gera um erro
        if ($valor != $confirmed) {
            $this->validacoes[] = "$campo confirmação esta diferente!";
        }
    }

    /**
     * Valida se o valor digitado respeita o limite mínimo de caracteres.
     */
    private function min($campo, $regraAr, $valor)
    {
        // Se o comprimento da string digitada for menor do que o configurado na regra (ex: < 6)
        if (strlen($valor) < $regraAr) {
            $this->validacoes[] = "A $campo tem que ter no minimo $regraAr caracteres";
        }
    }

    /**
     * Valida se o valor digitado não ultrapassa o limite máximo de caracteres.
     */
    private function max($campo, $regraAr, $valor)
    {
        // Se o comprimento da string digitada ultrapassar o configurado na regra (ex: > 64)
        if (strlen($valor) > $regraAr) {
            $this->validacoes[] = "A $campo tem que ter no maximo $regraAr caracteres";
        }
    }

    /**
     * Valida se o campo possui pelo menos um caractere especial (forçando uma senha forte).
     */
    private function strong($campo, $valor)
    {
        // strpbrk procura na string qualquer caractere contido na lista fornecida. 
        // Se não encontrar nenhum deles (!), gera o erro de senha fraca
        if (!strpbrk($valor, '!@#$%^*&()?/')) {
            $this->validacoes[] = "O $campo tem que ter um caracter especial!";
        }
    }

    /**
     * Conecta ao banco de dados e valida se o valor já existe na tabela indicada (evitando registros duplicados).
     */
    private function unique($campo, $tabela, $valor)
    {
        // Se o campo estiver vazio, não faz sentido buscar duplicidade no banco, então encerra a função
        if (strlen($valor) == 0) {
            return;
        }

        // Abre uma nova conexão com o banco de dados passando as configurações padrão
        $db = new DB(config('database'));

        // Consulta dinamicamente a tabela e a coluna para verificar se o registro existe
        $resultado = $db->query(
            sql: "select * from $tabela where $campo = :valor",
            params: compact('valor') // compact('valor') cria um array ['valor' => $valor] de forma curta
        )->fetch();
  
        // Se o banco retornar alguma linha, significa que já existe um cadastro com esse valor (ex: e-mail duplicado)
        if ($resultado) {
            $this->validacoes[] = "O $campo ja existe!";
        }
    }

    /**
     * Finaliza o fluxo salvando as mensagens de erro na sessão (flash) para exibi-las na View.
     * Retorna um booleano (true/false) indicando se a validação falhou.
     */
    public function naoPassou($nomeCustomizado = null)
    {
        // Define o nome padrão da chave da sessão que guardará os erros
        $chave = 'validacoes';

        // Se passarmos um nome no controlador (ex: 'registro'), a chave vira 'validacoes_registro'
        if ($nomeCustomizado) {
            $chave .= '_' . $nomeCustomizado;
        }

        // Envia a lista de erros ($this->validacoes) para a sessão usando a função flash()
        flash()->push($chave, $this->validacoes);

        // sizeof() conta quantos erros foram gerados. 
        // Se o número for maior que 0, retorna 'true' (indicando que a validação falhou e não passou).
        return sizeof($this->validacoes) > 0;
    }
}