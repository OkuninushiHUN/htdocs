<?php

namespace App;
use PDO;


/***
 * @mixin PDO
 */

//Singleton
class DB
{
    private static DB|null $instance = null;
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new DB();
        }
        return self::$instance;
    }

    private  PDO $pdo;

    private  function __construct()
    {
        $options=[PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];

        $this->pdo= new PDO(
            'mysql:host=localhost;dbname=bot_konyvtar',
            'root','',
            $options
        );
    }
    public function __call(string $name, array $arguments){
        return call_user_func_array([$this->pdo,$name], $arguments);
    }


}