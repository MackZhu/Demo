<?php
namespace Common;
{
    class Core
    {
        protected $_config = [];
        
        public function __construct($config)
        {
            $this->_config = $config;
        }

        // 运行程序
        public function run()
        {
            //spl_autoload_register("Common\core::loadClass");
            spl_autoload_register(array($this, 'loadClass'));
            $this->removeMagicQuotes();
            $this->unregisterGlobals();
            $this->setDbConfig();
            
        }

        // 检测敏感字符并删除
        public function removeMagicQuotes()
        {
            if (get_magic_quotes_gpc()) {
                $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
                $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
                $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
                $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
            }
        }

        // 检测自定义全局变量并移除。因为 register_globals 已经弃用，如果
        // 已经弃用的 register_globals 指令被设置为 on，那么局部变量也将
        // 在脚本的全局作用域中可用。 例如， $_POST['foo'] 也将以 $foo 的
        // 形式存在，这样写是不好的实现，会影响代码中的其他变量。 相关信息，
        // 参考: http://php.net/manual/zh/faq.using.php#faq.register-globals
        public function unregisterGlobals()
        {
            if (ini_get('register_globals')) {
                $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
                foreach ($array as $value) {
                    foreach ($GLOBALS[$value] as $key => $var) {
                        if ($var === $GLOBALS[$key]) {
                            unset($GLOBALS[$key]);
                        }
                    }
                }
            }
        }

        // 配置数据库信息
        public function setDbConfig()
        {
            if ($this->_config['db']) {
                Model::$dbConfig = $this->_config['db'];
            }
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