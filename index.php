<?php

//实现注册树
class Base{

}

class Pig{

}
//单例模式
class Single extends Base{
    public $hash;
    static protected $instance = null;
    final protected function __construct(){
        $this->hash = rand(1,9999);
    }

    static public function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new self();
        }

        return self::$instance;
    }
}

//工厂
class RandFactory{
    public static function factory(){
        return Single::getInstance();
    }
}

//注册
class Register{
    protected static $objs;
    public static function set($alias, $obj){
        self::$objs[$alias] = $obj;
    }
    public static function get($alias){
        return self::$objs[$alias];
    }
    public static function _unset($alias){
        unset(self::$objs[$alias]);
    }
}

Register::set('rand', RandFactory::factory());
$object = Register::get('rand');

print_r($object);

//复杂的工厂

class MyFactory{
    protected $mclass;
    final function __construct(Base $obj){
        $this->mclass = $obj;
    }
    static public function factory(){
        return $this->mclass;
    }
}

$obj = new MyFactory(new Pig());

print_r($obj);