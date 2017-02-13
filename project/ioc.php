<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'closure_dump.php';


class Db
{
    private $config;

    function __construct($config = [])
    {
        $this->config = $config;
    }

    public function connect()
    {
        return $this->config;
    }
}

class Config
{
    private $config;

    function __construct($config = [])
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}

class User
{
    private $db;

    private $config;

    public function setDb(Db $db)
    {
        $this->db = $db;
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }
}


class IoC
{
    protected static $registry = [];

    public static function register($name, Closure $resolve)
    {
        static::$registry[$name] = $resolve;
    }

    public static function registered($name)
    {
        return array_key_exists($name, static::$registry);
    }

    public static function resolve($name)
    {

        if (!static::registered($name)) {
            throw new Exception(sprintf('%s is not registerd', $name));
        }

        $name = static::$registry[$name];

        //ponieważ pozniej będziemy przekazywać $ioc
        //aby dla klasy User wywołać $ioc
        return $name(new self);
    }
}

$ioc = new IoC;
$ioc::register('db', function () {
    return new Db([
        'username' => 'root',
        'password' => 'toor',
        'schema' => 'test',
    ]);
});
$ioc::register('config', function () {
    return new Config([
        'login' => 'Dariusz',
        'pass' => 'secret',
    ]);
});


$ioc::register('user', function (IoC $ioc) {

    $db = $ioc::resolve('db');
    $config = $ioc::resolve('config');

    $user = new User();
    $user->setDb($db);
    $user->setConfig($config);

    return $user;
});
$db = $ioc::resolve('db');

$config = $ioc::resolve('config');
$user = $ioc::resolve('user');

//var_dump($user);