<?php

class DB
{
    // Armazena a instância da conexão PDO para que ela possa ser usada nos métodos da classe
    public $db;

    /**
     * Método Construtor. 
     * Roda automaticamente assim que você dá um "new DB($config)".
     * * @param array $config O array com as credenciais do banco que vêm do 'config.php'
     */
    public function __construct($config)
    {
        // Cria a conexão oficial com o banco de dados usando a classe nativa PDO do PHP
        // O método getDsn() formata a string de conexão que o PDO exige
        $this->db = new PDO($this->getDsn($config));
    }

    /**
     * Transforma o array de configuração em uma String de Conexão (DSN - Data Source Name).
     * O PDO exige que a string de conexão siga um formato específico (ex: "mysql:host=localhost;port=3306;dbname=ClickVagas;charset=utf8mb4").
     */
    private function getDsn($config)
    {
        // 1. Guarda o driver que está sendo usado (ex: 'mysql')
        $driver = $config['driver'];

        // 2. O PDO do MySQL espera o nome da base de dados como 'dbname', mas no arquivo 'config.php' 
        // você definiu como 'database'. Esta condição renomeia a chave para não quebrar a conexão.
        if (isset($config['database'])) {
            $config['dbname'] = $config['database'];
            unset($config['database']); // Apaga a chave antiga 'database'
        }

        // 3. O http_build_query() pega o array restante (host, port, dbname, charset) 
        // e o transforma em uma string separada por ponto e vírgula (;).
        // Ex de resultado: "mysql:host=localhost;port=3306;dbname=ClickVagas;charset=utf8mb4"
        $dsn = $driver . ':' . http_build_query($config, '', ';');

        return $dsn;
    }

    /**
     * Prepara e executa qualquer instrução SQL no banco de dados de forma segura.
     * string $sql A query SQL (ex: "SELECT * FROM vagas WHERE modelo = :modelo")
     * string|null $class Se fornecida, transforma as linhas retornadas em objetos dessa classe (ex: Vagas::class)
     * array $params Os valores que vão substituir os placeholders/tokens da query de forma segura
     * return PDOStatement Retorna o objeto preparado e já executado para ser usado com fetch() ou fetchAll()
     */
    public function query($sql, $class = null, $params = [])
    {
        // 1. Prepara a query no banco de dados. Isso impede SQL Injection porque o banco "separa" 
        // o comando SQL dos dados que o usuário digitou.
        $prepare = $this->db->prepare($sql);

        // 2. Se você passou o nome de uma Classe no segundo parâmetro:
        if ($class) {
            // Configura o PDO para que ele não retorne apenas arrays comuns, mas sim objetos 
            // mapeados diretamente para a classe que você indicou (ex: se passar Vagas::class, vira um objeto da classe Vagas)
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        // 3. Executa a query substituindo os tokens (ex: ':modelo') pelos valores reais limpos de dentro de $params
        $prepare->execute($params);

        // Retorna o resultado pronto
        return $prepare;
    }
}

// Cria a variável global $database que será usada em todos os controladores para fazer consultas.
// Ela utiliza as credenciais do seu arquivo de configuração que foi importado no index.php
$database = new DB($config['database']);