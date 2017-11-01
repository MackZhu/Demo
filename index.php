<?php
use Common as common; //引用空间并加别名  

function autoLoadClass( $class ) {
    $file = $class  . '.class.php';  
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