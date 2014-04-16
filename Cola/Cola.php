<?php

/**
 * Define
 */
defined('COLA_DIR') || define('COLA_DIR', dirname(__FILE__));
require COLA_DIR . '/Config.php';

class Cola
{
    /**
     * Singleton instance
     *
     * Marked only as protected to allow extension of the class. To extend,
     * simply override {@link getInstance()}.
     *
     * @var Cola
     */
    protected static $_instance = null;

    /**
     * Object register
     *
     * @var array
     */
    public $reg = array();

    /**
     * Run time config
     *
     * @var Cola_Config
     */
    public $config;

    /**
     * Router
     *
     * @var Cola_Router
     */
    public $router;

    /**
     * Path info
     *
     * @var string
     */
    public $pathInfo;

    /**
     * Dispathc info
     *
     * @var array
     */
    public $dispatchInfo;

    /**
     * Constructor
     *
     */
    protected function __construct()
    {
        $this->config = new Cola_Config(array(
            '_class' => array(
                'Cola_Model'               => COLA_DIR . '/Model.php',
                'Cola_View'                => COLA_DIR . '/View.php',
                'Cola_Controller'          => COLA_DIR . '/Controller.php',
                'Cola_Router'              => COLA_DIR . '/Router.php',
                'Cola_Request'             => COLA_DIR . '/Request.php',
                'Cola_Response'            => COLA_DIR . '/Response.php',
                'Cola_Ext_Validate'        => COLA_DIR . '/Ext/Validate.php',
                'Cola_Exception'           => COLA_DIR . '/Exception.php',
                'Cola_Exception_Dispatch'  => COLA_DIR . '/Exception/Dispatch.php',
                'Cola_Exception_Dispatch'  => COLA_DIR . '/Exception/Dispatch.php',
                'Cola_Com'                 => COLA_DIR . '/Com.php',
                'Cola_Com_Widget'          => COLA_DIR . '/Com/Widget.php',
                'Cola_Exception'           => COLA_DIR . '/Exception.php'
            ),
        ));

        Cola::registerAutoload();
    }

    /**
     * Bootstrap
     *
     * @param mixed $arg string as a file and array as config
     * @return Cola
     */
    public static function boot($config = 'config.inc.php')
    {
        if (is_string($config) && file_exists($config)) {
            include $config;
        }

        if (!is_array($config)) {
            throw new Exception('Boot config must be an array or a php config file with variable $config');
        }

        self::getInstance()->config->merge($config);
        return self::$_instance;
    }

    /**
     * Singleton instance
     *
     * @return Cola
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Set Config
     *
     * @param string $name
     * @param mixed $value
     * @param string $delimiter
     * @return Cola
     */
    public static function setConfig($name, $value, $delimiter = '.')
    {
        self::getInstance()->config->set($name, $value, $delimiter);
        return self::$_instance;
    }

    /**
     * Get Config
     *
     * @return Cola_Config
     */
    public static function getConfig($name, $default = null, $delimiter = '.')
    {
        return self::getInstance()->config->get($name, $default, $delimiter);
    }
    
    public static function config(){
        return self::getInstance()->config;
    }

    /**
     * Set Registry
     *
     * @param string $name
     * @param mixed $obj
     * @return Cola
     */
    public static function setReg($name, $obj)
    {
        self::getInstance()->reg[$name] = $obj;
        return self::$_instance;
    }

    /**
     * Get Registry
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function getReg($name, $default = null)
    {
        $instance = self::getInstance();
        return isset($instance->reg[$name]) ? $instance->reg[$name] : $default;
    }

    /**
     * Common factory pattern constructor
     *
     * @param string $type
     * @param array $config
     * @return Object
     */
    public static function factory($type, $config)
    {
        $adapter = $config['adapter'];
        $class = $type . '_' . ucfirst($adapter);
        return new $class($config);
    }

    /**
     * Load class
     *
     * @param string $className
     * @param string $classFile
     * @return boolean
     */
    public static function loadClass($className, $classFile = '')
    {
        if (class_exists($className, false) || interface_exists($className, false)) {
            return true;
        }

        if ((!$classFile)) {
            $key = "_class.{$className}";
            $classFile = self::getConfig($key);
        }

        /**
         * auto load Cola class
         */
       /*  if ((!$classFile) && ('Cola' === substr($className, 0, 4))) {
            $classFile = dirname(COLA_DIR) . DIRECTORY_SEPARATOR
                       . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        }
 */
        /**
         * auto load controller class
         */
        /* if ((!$classFile) && ('Controller' === substr($className, -10))) {
            $classFile = self::getConfig('_controllersHome') . "/{$className}.php";
        } */

        /**
         * auto load model class
         */
        /* if ((!$classFile) && ('Model' === substr($className, -5))) {
            $classFile = self::getConfig('_modelsHome') . "/{$className}.php";
        } */
        
        //var_dump($className);
        $classFile = strtr($className,array('_'=>DIRECTORY_SEPARATOR)) . '.php';

        //if (file_exists($classFile)) {
            include $classFile;
        //}
        return true;
        //return (class_exists($className, false) || interface_exists($className, false));
    }

    /**
     * User define class path
     *
     * @param array $classPath
     * @return Cola
     */
    public static function setClassPath($class, $path = '')
    {
        if (!is_array($class)) {
            $class = array($class => $path);
        }

        self::getInstance()->config->merge(array('_class' => $class));

        return self::$_instance;
    }

    /**
     * Register autoload function
     *
     * @param string $func
     * @param boolean $enable
     * @return Cola
     */
    public static function registerAutoload($func = 'Cola::loadClass', $enable = true)
    {
        $enable ? spl_autoload_register($func) : spl_autoload_unregister($func);
        return self::$_instance;
    }

    /**
     * Get dispatch info
     *
     * @param boolean $init
     * @return array
     */
    public function getDispatchInfo($init = false)
    {
        if ((null === $this->dispatchInfo) && $init) {
            $this->router || ($this->router = new Cola_Router());
 
            if (!($urls = self::getConfig('_urls'))) {
                $this->router->rules += $urls;
            }

            $this->pathInfo || $this->pathInfo = (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '');

            $this->dispatchInfo = $this->router->match($this->pathInfo);
        }

        return $this->dispatchInfo;
    }

    /**
     * Dispatch
     *
     */
    public function dispatch()
    {
        if (!$dispatchInfo = $this->getDispatchInfo(true)) {
            throw new Cola_Exception_Dispatch('No dispatch info found');
        }

        if (isset($dispatchInfo['file'])) {
            if (!file_exists($dispatchInfo['file'])) {
                throw new Cola_Exception_Dispatch("Can't find dispatch file:{$dispatchInfo['file']}");
            }
            require  $dispatchInfo['file'];
        }

        if (isset($dispatchInfo['controller'])) {
           // $classFile = self::getConfig('_controllersHome') . "/{$dispatchInfo['controller']}.php";
          
            /* if (!self::loadClass($dispatchInfo['controller'], $classFile)) {
                throw new Cola_Exception_Dispatch("Can't load controller:{$dispatchInfo['controller']}");
            } */
            //var_dump( $dispatchInfo['controller']);die;
            $controller = new $dispatchInfo['controller']();
        }

        if (isset($dispatchInfo['action'])) {
            $func = isset($controller) ? array($controller, $dispatchInfo['action']) : $dispatchInfo['action'];
            if (!is_callable($func, true)) {
                throw new Cola_Exception_Dispatch("Can't dispatch action:{$dispatchInfo['action']}");
            }
            call_user_func($func);
        }
    }
}



class Cola2
{

    /**
     * Singleton instance
     *
     * Marked only as protected to allow extension of the class. To extend,
     * simply override {@link getInstance()}.
     *
     * @var Cola_Dispatcher
     */
    protected static $_instance = null;

    /**
     * Run time config
     *
     * @var Cola_Config
     */
    public static $_config;

    /**
     * Object register
     *
     * @var array
     */
    protected static $_reg = array();

    /**
     * Router
     *
     * @var Cola_Router
     */
    protected $_router;

    /**
     * Path info
     *
     * @var string
     */
    protected $_pathInfo = null;

    /**
     * Dispathc info
     *
     * @var array
     */
    protected $_dispatchInfo = null;
    
    protected static $_cacheClass = TRUE;
    
    protected static $_loadedClass = array();
    
    protected static $_cacheClassChanged = FALSE;

    /**
     * Constructor
     *
     */
    protected function __construct()
    {
        $config['_class'] = array(
            'Cola_Router' => COLA_DIR . '/Router.php',
            'Cola_Request' => COLA_DIR . '/Request.php',
            'Cola_Model' => COLA_DIR . '/Model.php',
            'Cola_View' => COLA_DIR . '/View.php',
            'Cola_Controller' => COLA_DIR . '/Controller.php',
            'Cola_Com' => COLA_DIR . '/Com.php',
            'Cola_Com_Widget' => COLA_DIR . '/Com/Widget.php',
            'Cola_Exception' => COLA_DIR . '/Exception.php'
        );

        self::$_config = new Cola_Config($config);

        Cola::registerAutoload();
    }

    /**
     * Bootstrap
     *
     * @param mixed $arg string as a file and array as config
     * @return Cola
     */
    public static function boot($config = 'config.inc.php')
    {
        if (is_string($config)) {
            include $config;
        }

        if (!is_array($config)) {
            throw new Exception('Boot config must be an array, if you use config file, the variable should be named $config');
        }

        self::$_config->merge($config);
        
         if(defined('DEBUG')===TRUE){
            set_exception_handler(array('Cola_Exception', 'handler'));
            set_error_handler ( array ('Cola','error_handler' ) );
        } 
       
        return self::$_instance;
    }
     
    public static function cache($name, $data = NULL, $lifetime = NULL) {
        static $cache = null;
        $regName = "_cache";
        if (!$cache = Cola::getReg($regName)) {
            $config = (array) Cola::$_config->get('_cache');
            $cache = Cola_Com_Cache::factory($config);
            Cola::setReg($regName, $cache);
        }
        if($data===NULL){
            return $cache->get($name);
        }
        return (bool) $cache->set($name, $data, $lifetime);
    }
    public static function error_handler($code, $error, $file = NULL, $line = NULL) {
    
        if ($code != 8 ) {
            ob_get_level () and ob_clean ();
            Cola_Exception::handler ( new ErrorException ( $error, $code, 0, $file, $line ) );
        }
        return TRUE;
    }
    /**
     * Singleton instance
     *
     * @return Cola
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Get Config
     *
     * @return Cola_Config
     */
    public static function Config()
    {
        return self::$_config;
    }

    /**
     * Get Config
     *
     * @return Cola_Config
     */
    public static function getConfig($name, $default = null, $delimiter = '.')
    {
        return self::$_config->get($name, $default, $delimiter);
    }

    /**
     * Set Config
     *
     * @param string $name
     * @param mixed $value
     * @param string $delimiter
     * @return Cola_Config
     */
    public static function setConfig($name, $value, $delimiter = '.')
    {
        return self::$_config->set($name, $value, $delimiter);
    }

    /**
     * Set Registry
     *
     * @param string $name
     * @param mixed $res
     * @return Cola
     */
    public static function setReg($name, $res)
    {
        self::$_reg[$name] = $res;
        return self::$_instance;
    }

    /**
     * Get Registry
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public static function getReg($name = null, $default = null)
    {
        if (null === $name) {
            return self::$_reg;
        }

        return isset(self::$_reg[$name]) ? self::$_reg[$name] : $default;
    }

    /**
     * Load class
     *
     * @param string $className
     * @param string $dir
     * @return boolean
     */
    public static function loadClass($className, $dir = NULL)
    {
        /* if (class_exists($className, false) || interface_exists($className, false)) {
            return true;
        }  */ 
        
        $key = "_class.{$className}";
        if (null !== self::$_config->get($key)) {
            include self::$_config->get($key);
            return true;
        }
       
        if ($dir===NULL) {
            if ('Cola' == substr($className, 0, 4)) {
                $dir =  substr(COLA_DIR, 0, -4);
            }else{
                $dir = '';
            }
            
        } else {
            $dir = rtrim($dir, '\\/') . DIRECTORY_SEPARATOR;
        }
        if(strpos($className, 'Tables') !== FALSE){ 
            self::loadTableClass($className);
            return TRUE;
        } 
        $file = strtr($className,array('_'=>DIRECTORY_SEPARATOR)) . '.php';
         
        
        $classFile = $dir . $file;
        
        //$appClassFile = 'models'.DIRECTORY_SEPARATOR.$classFile;
        //$k = COLA_DIR.DIRECTORY_SEPARATOR.$classFile;
        //var_dump($classFile);
        
        include($classFile);
         /*  if (!class_exists($className, false)) {
            throw new Cola_Exception("Unable to load class: $className",array(), E_USER_WARNING);
        }   */
        return TRUE;
         
        
         
       // return (class_exists($className, false) || interface_exists($className, false));
    }
    
    public static function loadTableClass ($className)
    {
       // if (strpos($className, 'Tables') !== FALSE) {
            $class = substr($className, 7);
            $classFile = 'Tables' . DIRECTORY_SEPARATOR . $class . '.php';
            include ($classFile);
            return TRUE;
       // }
       // return FALSE;
    }
    
    

    /**
     * User define class path
     *
     * @param array $classPath
     * @return Cola
     */
    public static function setClassPath($class, $path = '')
    {
        if (!is_array($class)) {
            $class = array($class => $path);
        }

        self::$_config->merge(array('_class' => $class));

        return self::$_instance;
    }

    /**
     * Register autoload function
     *
     * @param string $func
     * @param boolean $enable
     */
    public static function registerAutoload($func = 'Cola::loadClass', $enable = true)
    {
        $enable ? spl_autoload_register($func) : spl_autoload_unregister($func);
    }

    /**
     * Set router
     *
     * @param Cola_Router $router
     * @return Cola
     */
    public function setRouter($router = null)
    {
        if (null === $router) {
            $router = Cola_Router::getInstance();
        }

        $this->_router = $router;

        return $this;
    }

    /**
     * Get router
     *
     * @return Cola_Router
     */
    public function getRouter()
    {
        if (null === $this->_router) {
            $this->setRouter();
        }

        return $this->_router;
    }

    /**
     * Set path info
     *
     * @param string $pathinfo
     * @return Cola
     */
    public function setPathInfo($pathinfo = null)
    {
        if (null === $pathinfo) {
            $pathinfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        }

        $this->_pathInfo = $pathinfo;

        return $this;
    }

    /**
     * Get path info
     *
     * @return string
     */
    public function getPathInfo()
    {
        if (null === $this->_pathInfo) {
            $this->setPathInfo();
        }

        return $this->_pathInfo;
    }

    /**
     * Set dispatch info
     *
     * @param array $dispatchInfo
     * @return Cola
     */
    public function setDispatchInfo($dispatchInfo = null)
    {
        if (null === $dispatchInfo) {
            $router = $this->getRouter();
            // add urls to router from config
            $urls = self::$_config->get('_urls');
            if ($urls) {
                $router->add($urls, false);
            }
            $pathInfo = $this->getPathInfo();
            $dispatchInfo = $router->match($pathInfo);
        }

        $this->_dispatchInfo = $dispatchInfo;

        return $this;
    }

    /**
     * Get dispatch info
     *
     * @return array
     */
    public function getDispatchInfo()
    {
        if (null === $this->_dispatchInfo) {
            $this->setDispatchInfo();
        }

        return $this->_dispatchInfo;
    }

    /**
     * Dispatch
     *
     */
    public function dispatch()
    {
        if (!$this->getDispatchInfo()) {
            throw new Cola_Exception_Dispatch('No dispatch info found');
        }

        if (isset($this->_dispatchInfo['file'])) {
            if (!file_exists($this->_dispatchInfo['file'])) {
                throw new Cola_Exception_Dispatch("Can't find dispatch file:{$this->_dispatchInfo['file']}");
            }
            require_once $this->_dispatchInfo['file'];
        }

        if (isset($this->_dispatchInfo['controller'])) {
           // var_dump($this->_dispatchInfo);die;
            /* if (!self::loadClass($this->_dispatchInfo['controller'], self::$_config->get('_controllersHome'))) {
                
                throw new Cola_Exception_Dispatch("Can't load controller:{$this->_dispatchInfo['controller']}");
            } */
            $cls = new $this->_dispatchInfo['controller']();
        } 
        
        if (isset($this->_dispatchInfo['action'])) {
           // $func = isset($cls) ? array($cls, $this->_dispatchInfo['action']) : $this->_dispatchInfo['action'];
            if(isset($cls)){
                $func = array($cls,$this->_dispatchInfo['action']);
            }else{
                $func = $this->_dispatchInfo['action'];
            }
            
            /* if (!is_callable($func, true)) {
                throw new Cola_Exception_Dispatch("Can't dispatch action:{$this->_dispatchInfo['action']}");
            } */
            call_user_func($func);
        }
    }

}