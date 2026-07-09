<?php

class Validacao
{


    public $validacoes = [];


    public static function validar($regras, $dados)
    {


        /**
         * 
         * Campo = nome , email
         * Regra = required, email
         * 
         */

        $validacao = new self;

        foreach ($regras as $campo => $regrasDoCampo) {

            foreach ($regrasDoCampo as $regra) {
                $valorDocampo = $dados[$campo];

                if ($regra == 'confirmed') {
                    $validacao->$regra($campo, $valorDocampo, $dados["confirmar_{$campo}"]);
                } else if (str_contains($regra, ':')) {

                    $temp = explode(':', $regra);
                    $regra = $temp[0];
                    $regraAr = $temp[1];

                    $validacao->$regra($campo, $regraAr, $valorDocampo);
                } else {
                    $validacao->$regra($campo, $valorDocampo);
                }
            }
        }

        return $validacao;
    }

    private function required($campo, $valor)                                                 
    {

        if (strlen($valor) == 0) {
            $this->validacoes[] = "O $campo é obrigatorio!";
        }
    }

    private function email($campo, $valor)
    {
        if (! filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->validacoes[] = "O $campo deve ser um $campo valido!";
        }
    }

    private function confirmed($campo, $valor, $confirmed)
    {
        if ($valor != $confirmed) {
            $this->validacoes[] = "$campo confirmação esta diferente!";
        }
    }

    private function min($campo, $regraAr, $valor)
    {
        if (strlen($valor) < $regraAr) {
            $this->validacoes[] = "A $campo tem que ter no minimo $regraAr caracteres";
        }
    }

    private function max($campo, $regraAr, $valor)
    {
        if (strlen($valor) > $regraAr) {
            $this->validacoes[] = "A $campo tem que ter no maximo $regraAr caracteres";
        }
    }

    private function strong($campo, $valor)
    {
        if (!strpbrk($valor, '!@#$%^*&()?/')) {
            $this->validacoes[] = "O $campo tem que ter um caracter especial!";
        }
    }

     private function unique($campo, $tabela, $valor)
    {
        if (strlen($valor) == 0) {
            return;
        }

        $db = new DB(config('database'));

        $resultado = $db->query(
            sql: "select * from $tabela where $campo = :valor",
            params: compact('valor')
        )->fetch();
  
        if ($resultado) {
            $this->validacoes[] = "O $campo ja existe!";
        }
    }

    public function naoPassou($nomeCustomizado = null)
    {

        $chave = 'validacoes';

        if ($nomeCustomizado) {
            $chave .= '_' . $nomeCustomizado;
        }

        flash()->push($chave, $this->validacoes);

        return sizeof($this->validacoes) > 0;
    }
}

