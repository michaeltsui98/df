<?php

/**
 * Define
 */
defined('COLA_DIR') || define('COLA_DIR', dirname(__FILE__));
require_once COLA_DIR . '/Config.php';

class Cola
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
        
        set_exception_handler(array('Cola_Exception', 'handler'));
        set_error_handler ( array ('Cola','error_handler' ) );
        
        /* if(self::$_cacheClass === TRUE){
            static::$_loadedClass = static::cache('loader_class');
        } */
        //register_shutdown_function ( array ('Cola','shutdown_handler') );
        return self::$_instance;
    }
    public static function shutdown_handler() {
        
        if (self::$_cacheClass === TRUE AND self::$_cacheClassChanged === TRUE){
            static::cache('loader_class', self::$_loadedClass);
        }
 
    }
    public static function cache($name, $data = NULL, $lifetime = NULL) {
        
        $regName = "_cache_cache";
        if (!$this->_cache = Cola::getReg($regName)) {
            $config = (array) Cola::$_config->get('_cache');
            $_cache = Cola_Com_Cache::factory($config);
            Cola::setReg($regName, $_cache);
        }
        if($data===NULL){
            return $_cache->get($name);
        }
        return (bool) $_cache->set($name, $data, $lifetime);
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
    public static function loadClass($className, $dir = '')
    {
        if (class_exists($className, false) || interface_exists($className, false)) {
            return true;
        } 
        
        $key = "_class.{$className}";
        if (null !== self::$_config->get($key)) {
            include self::$_config->get($key);
            return true;
        }
       
        if (empty($dir)) {
            $dir = ('Cola' == substr($className, 0, 4)) ? substr(COLA_DIR, 0, -4) : '';
            
        } else {
            $dir = rtrim($dir, '\\/') . DIRECTORY_SEPARATOR;
        }
        if(strpos($className, 'Tables') !== FALSE 
                AND self::loadTableClass($className)){
            return TRUE;
        }
        $file = strtr($className,array('_'=>DIRECTORY_SEPARATOR)) . '.php';
         
        
        $classFile = $dir . $file;
        
        //$appClassFile = 'models'.DIRECTORY_SEPARATOR.$classFile;
        //$k = COLA_DIR.DIRECTORY_SEPARATOR.$classFile;
        //var_dump($classFile);
        
        include($classFile);
          if (!class_exists($className, false)) {
            throw new Cola_Exception("Unable to load class: $className",array(), E_USER_WARNING);
        }  
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
           // self::loadClass($this->_dispatchInfo['controller']);die;
            //var_dump($this->_dispatchInfo['controller'], self::$_config->get('_controllersHome'));die;
            if (!self::loadClass($this->_dispatchInfo['controller'])) {
                //if (!self::loadClass($this->_dispatchInfo['controller'], self::$_config->get('_controllersHome'))) {
                throw new Cola_Exception_Dispatch("Can't load controller:{$this->_dispatchInfo['controller']}");
            }
            $cls = new $this->_dispatchInfo['controller']();
        }

        if (isset($this->_dispatchInfo['action'])) {
            $func = isset($cls) ? array($cls, $this->_dispatchInfo['action']) : $this->_dispatchInfo['action'];
            if (!is_callable($func, true)) {
                throw new Cola_Exception_Dispatch("Can't dispatch action:{$this->_dispatchInfo['action']}");
            }
            call_user_func($func);
        }
    }

}