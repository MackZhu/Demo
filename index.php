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

$config = new common\config();

(new common\core($config))->run();



echo "Hello World";



?>