<?php

use  Common as common; //引用空间并加别名  

function loadprint( $class ) {
    $file = $class  . '.class.php';  
    if (is_file($file))
    {  
        require_once($file);
    } 
    else
    {
        echo "<br>xxx";
    }
}

spl_autoload_extensions('.class.php,.interface.php');  
spl_autoload_register();
//spl_autoload_register('loadprint'); 
   
$obj = new common\PRINTIT();
$obj->doPrint();


?>