<?php

/**
 *
 */
class Cola_Controller
{

    /**
     * The home directory of model
     *
     * @var string
     */
    protected $_modelsHome = null;

    /**
     * The home directory of view
     *
     * @var string
     */
    protected $_viewsHome = null;

    /**
     * Template file extension
     *
     * @var string
     */
    protected $_tplExt = '.php';

    /**
     * Form keys
     *
     * @var array
     */
    protected $_keys = array();

    /**
     * Error
     *
     * @var array
     */
    protected $_error;
    
    /**
     * 是否开启视图缓存
     * @var bool
     */
    protected  $_isCache = false;
    
    /**
     * 视图缓存前缀
     * @var string
     */
    protected  $_cachePrex = '';
    
    /**
     * 视图缓存时间
     * @var int
     */
    protected $_lifeTime = 900;
    
 
    /**
     * Constructor
     *
     * Init $_modelsHome & $_viewsHome from config if they are null
     */
    public function __construct()
    {
         
    }
    
    
    /**
     * Magic method
     *
     * @param string $methodName
     * @param array $args
     */
    public function __call($methodName, $args)
    {
        throw new Exception("Call to undefined method: Cola_Controller::$methodName()");
    }

    /**
     * View
     *
     * @param array $config
     * @return Cola_View
     */
    protected function view($params = array())
    {
        $params = (array) $params + array('basePath' => $this->_viewsHome) + (array) Cola::getInstance()->config->get('_view');

        return $this->view = new Cola_View($params);
    }
    /**
     * 设置布局
     * @param string $layout
     */
    protected  function setLayout($layout){
    	$this->view->setLayout($layout);
    }
    /**
     * 获取当前默认布局
     */
    public  function getCurrentLayout($controller){
    	
    	$arr = explode('_', $controller);
    	$modules = array_flip(Cola::config()->get('_modules'));
    	$layout = '';
    	if(isset($modules[$arr[1]])){
    	   	 $layout = current($arr).'/'.next($arr).'/Views/Layout/';
    	}else{
    		 $layout = 'views/layout/';
    	}
    	
    	return $layout;
    }
    /**
     * 开启视图缓存
     * @param string $isCache
     * @param string $prex
     * @param int $lifeTime  如果$lifeTime=0 则删除视图缓存 
     */
    protected  function setViewCache($isCache=true,$prex=null,$lifeTime=null){
    	$this->_isCache = $isCache;
    	$this->_cachePrex = $prex;
    	if($lifeTime!==null){
    		  $this->_lifeTime = $lifeTime;
    	}
    }
    /**
     * Display the view
     *
     * @param string $tpl
     */
    protected function display($tpl = null, $dir = null)
    {
        NULL === $tpl && $tpl = $this->defaultTemplate();
        $this->view->display($tpl, $dir);
    }
    /**
     * 加载模板
     */
    protected  function tpl($tpl=null,$layout=null){
    	NULL== $tpl and $tpl = $this->defaultTpl();
    	if($this->_isCache==true){
	    	$key = 'views:'.hash('md5',$_SERVER['REQUEST_URI'].$this->_cachePrex);
	    	
	    	if($this->_lifeTime==0){
	    		//删除缓存
	    		self::cache()->delete($key);
	    	}else{
	    		$content = self::cache()->get($key);
	    		if($content){
	    			echo $content;
	    			return false;
	    		}
	    	}
	    	
	    	$content = $this->view->tpl($tpl,$layout,true);
    		if($content and $this->_lifeTime){
    			self::cache()->set($key,$content,$this->_lifeTime);
    		}
    		echo $content;
	    }else{
	    	$this->view->tpl($tpl,$layout);
    	}
    }
    /**
     * @return Cola_Com_Cache
     */
    protected static function cache(){
    	$config = (array) Cola::$_config->get('_cache');
    	return  Cola_Com_Cache::factory($config);
    }
    

    /**
     * to 404
     */
    public function to404()
    {
        header("Location: /404.html", true, 302);
        exit;
    }

    /**
     *  message
     *  @param string $url   redirect url; param: goback, close, blank
     *  @param string $message  detail messages
     *  @param integer $ms time step, default 3 second.
     */
    protected function messagePage($url = '/', $message = 'goto home', $ms = 3000)
    {
        $this->view->messageArray = array();
        $this->view->messageArray['url'] = $url;
        $this->view->messageArray['message'] = $message;
        $this->view->messageArray['ms'] = $ms;
        $this->display('message.php', 'views/Index');
        exit;
    }

    /**
     * Get default template file path
     *
     * @return string
     */
    protected function defaultTemplate()
    {
        $cola = Cola::getInstance();
        $dispatchInfo = $cola->getDispatchInfo();

        $tpl = str_replace('_', DIRECTORY_SEPARATOR, substr($dispatchInfo['controller'], 0, -10))
                . DIRECTORY_SEPARATOR
                . substr($dispatchInfo['action'], 0, -6)
                . $this->_tplExt;
        return $tpl;
    }
    /**
     * 指定默认的模板
     */
    protected  function defaultTpl(){
    	$cola = Cola::getInstance();
    	$dispatchInfo = $cola->getDispatchInfo();
    	$controller = strtr($dispatchInfo['controller'],array('Controllers_'=>'','controllers_'=>''));
    	$controller = strtr($controller,array('_'=>'/'));
    	$action  = strtr($dispatchInfo['action'], array('Action'=>''));
    	$controller_arr = explode('_', $dispatchInfo['controller']);
    	$tmp = current($controller_arr);
    	
    	if($tmp=='Modules'){
    		return current($controller_arr).'/'.next($controller_arr).'/Views/'.end($controller_arr).'/'.$action.'.htm';
    	}
    	//$modules = array_flip(Cola::config()->get('_modules'));
    	//die;
    	return $controller.'/'.$action;
    }

    /**
     * Instantiated model
     *
     * @param string $name
     * @param string $dir
     * @return Cola_Model
     */
    protected function model($name = null, $dir = null)
    {
        if (null === $name) {
            return $this->model;
        }

        null === $dir && $dir = $this->_modelsHome;
        $class = ucfirst($name) . 'Model';
        //$class = $name;
        //var_dump($class,$dir);die;
        if (Cola::loadClass($class, $dir)) {
            return new $class();
        }
        
        throw new Cola_Exception("Can't load model '$class' from '$dir'");
    }
    


    /**
     * Set model home directory
     *
     * @param string $dir
     * @return Cola_Controller
     */
    protected function setModelsHome($dir)
    {
        $this->_modelsHome = $dir;
        return $this;
    }

    /**
     * Set view home directory
     *
     * @param string $dir
     * @return Cola_Controller
     */
    protected function setViewsHome($dir)
    {
        $this->_viewsHome = $dir;
        return $this;
    }

    /**
     * Get var
     *
     * @param sting $key
     * @param mixed $default
     */
    protected function getVar($key = null, $default = null)
    {
        if (null === $key) {
            return array_merge((array)Cola::getReg('_params', null, array()), $_GET, $_POST, $_COOKIE, $_SERVER, $_ENV);
        }

        $funcs = array('param', 'get', 'post', 'cookie', 'server', 'env');

        foreach ($funcs as $func) {
            if (null !== ($return = $this->request->$func($key))) return $return;
        }

        return $default;
    }

    /**
     * Post var
     *
     * @param string $key
     * @param mixed $default
     */
    protected function post($key = null, $default = null)
    {
        return $this->request->post($key, $default);
    }

    /**
     * Get var
     *
     * @param string $key
     * @param mixed $default
     */
    protected function get($key = null, $default = null)
    {
        return $this->request->get($key, $default);
    }

    /**
     * Get data from form
     *
     * @param array $keys
     * @param string $method
     * @return array
     */
    protected function form($keys = null, $method = 'post')
    {
        $data = array();

        if (null === $keys && !$keys = $this->_keys) {
            return $this->request->{$method}();
        }

        if (isset($keys[0])) {
            foreach ($keys as $v) {
                $fKeys[$v] = $v;
            }
        }

        foreach ($fKeys as $k => $v) {
            $tmp = $this->request->{$method}($k);
            if (null !== $tmp) $data[$v] = trim($tmp);
        }

        return $data;
    }

    /**
     * Redirect to other url
     *
     * @param string $url
     */
    protected function redirect($url, $code = 302)
    {
        $this->response->redirect($url, $code);
    }

    /**
     * Abort
     *
     * @param mixed $data
     *
     */
    protected function abort($data)
    {
        if (!is_string($data)) {
            $data = json_encode($data);
        }
        echo $data;
        exit();
    }

    /**
     * Display JSON
     *
     * @param mixed $data
     * @param string $var
     */
    protected function json($data, $var = null)
    {
        $str = json_encode($data);
        if (!is_null($var)) {
            $str = "var {$var}={$str};";
        }
        echo $str;
    }

    /**
     * Dynamic set vars
     *
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value = null)
    {
        $this->$key = $value;
    }
     
    /**
     * @return Cola_Request
     */
    public static function request(){
        static $request = NULL;
        if($request ===NULL){
            return $request =  new Cola_Request();
        }
       return  $request;
    }
    /**
     * @return Cola_Response|Ambigous <NULL, Cola_Response>
     */
    public static function response(){
    	static $response = NULL;
    	if($response === NULL){
    		return $response = new Cola_Response();
    	}
    	return $response;
    }
   
    
    public function __get($key)
    {
        switch ($key) {
            case 'view':
                $this->view();
                return $this->view;

            case 'model':
                $class = get_class($this);
                $this->model = $this->model(substr($class, 0, -10));
                return $this->model;

            case 'helper':
                $this->helper = new Cola_Helper();
                return $this->helper;

            case 'com':
                $this->com = new Cola_Com();
                return $this->com;

            case 'request':
                $this->request = new Cola_Request();
                return $this->request;

            case 'response':
                $this->response = new Cola_Response();
                return $this->response;

            case 'config':
                $this->config = Cola::getInstance()->config;
                return $this->config;

            default:
                throw new Cola_Exception('Undefined property: ' . get_class($this) . '::' . $key);
        }
    }

}