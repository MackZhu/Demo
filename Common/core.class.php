<?php
namespace Common;
{
    class core
    {
        protected $_config = [];
        
        public function __construct($config)
        {
            $this->_config = $config;
        }

        // 运行程序
        public function run()
        {
            spl_autoload_register("Common\core::loadClass");
        }

        // 自动加载控制器和模型类 
        public static function loadClass($class)
        {
            $file = $class  . '.class.php';  
            if (is_file($file))
            {  
                require_once($file);
            } 
        }
    }
}
?>