<?php

class Singleton
{

    private static $link;
    private static $instance;

    private function __construct($config)
    {
        self::$link = mysqli_connect($config['server'], $config['user'], $config['password'], $config['database']);
    }

    private function __clone()
    {
    }

    public static function getInstance($config)
    {
        if (!self::$instance) {
            self::$instance = new Singleton($config);
        }

        return self::$instance;
    }

    public function connect()
    {
        return self::$link;
    }
}

$config = [
    'server' => 'mysql',
    'user' => 'root',
    'password' => 'toor',
    'database' => 'lifeofcto',
];

//$singleton = new Singleton();
$i = Singleton::getInstance($config)->connect();

echo '<pre>';
var_dump($i);
echo '</pre>';
