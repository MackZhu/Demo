<?php
use Common as common; //引用空间并加别名  

// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');


function autoLoadClass( $class ) {
    $file = $class  . '.class.php';  

    echo "<br>X ".$file."<br>";

    
    if (is_file($file))
    {  
        require_once($file);
    } 
}

spl_autoload_register('autoLoadClass'); 

$config = new common\Config();

(new common\Core($config->getConfig()))->run();



echo "Hello World";



?>