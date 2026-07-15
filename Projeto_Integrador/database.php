<?php


class DB
{

    public $db;

    public function __construct($config)
    {
        
        $this->db = new PDO($this->getDsn($config));
    }

    private function getDsn($config)
    {

        $driver = $config['driver'];

        if (isset($config['database'])) {
            $config['dbname'] = $config['database'];
            unset($config['database']);
        }

        $dsn = $driver . ':' . http_build_query($config, '', ';');

        return $dsn;
    }

    public function query($sql, $class = null, $params = [])
    {
        $prepare = $this->db->prepare($sql);
        if ($class) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        $prepare->execute($params);
        return $prepare;
    }
}

$database = new DB($config['database']);
