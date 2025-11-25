<?php
class Framework
{
    private static $instance;
    private $smarty;
    private $hooks;
    private $router;
    private $db;
    private $mailer;
    private $templateHook;
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct()
    {
        $this->initialize();
    }
    
    private function initialize()
    {
        // Initialize Smarty first (no dependencies)
        $this->initializeSmarty();
        
        // Initialize Hook Manager (no dependencies)
        $this->hooks = new HookManager();
        
        // Initialize Router (needs hooks)
        $this->router = new Router($this->hooks);
        
        // Initialize Database (needs config constants)
        $this->db = Database::getInstance();
        
        // Initialize Template Hook (needs hooks)
        $this->templateHook = new TemplateHook($this->hooks);
        
        // Register Smarty plugins
        $this->registerSmartyPlugins();
        
        // Load core hooks
        $this->loadCoreHooks();
    }
    
    #	private function initializeSmartyAlt()
    #	{
    #	    $this->smarty = new Smarty();
    #	    
    #	    // Configure Smarty paths
    #	    $this->smarty->setTemplateDir(APP_PATH . '/views/');
    #	    $this->smarty->setCompileDir(APP_PATH . '/cache/views_c/');
    #	    $this->smarty->setCacheDir(APP_PATH . '/cache/');
    #	    $this->smarty->setConfigDir(APP_PATH . '/config/');
    #	    
    #	    // Smarty configuration
    #	    $this->smarty->caching = false;
    #	    $this->smarty->debugging = false;
    #	}
	
	private function initializeSmarty()
	{
		$this->smarty = new Smarty();
		
		// Configure Smarty paths
		$this->smarty->setTemplateDir(APP_PATH . '/views/');
		$this->smarty->setCompileDir(APP_PATH . '/cache/views_c/');
		$this->smarty->setCacheDir(APP_PATH . '/cache/');
		$this->smarty->setConfigDir(APP_PATH . '/config/');
		
		// Smarty configuration
		$this->smarty->caching = false;
		$this->smarty->debugging = false;
		
		// Force compile in development
		if (defined('APP_DEBUG') && APP_DEBUG) {
			$this->smarty->force_compile = true;
		}
	}
    
    private function registerSmartyPlugins()
    {
        $this->smarty->registerPlugin('function', 'hook', [$this, 'smartyHookFunction']);
        $this->smarty->registerPlugin('block', 'hookblock', [$this, 'smartyHookBlock']);
    }
    
    public function smartyHookFunction($params, $smarty)
    {
        if (!isset($params['name'])) {
            return '';
        }
        
        $hookName = $params['name'];
        $hookParams = $params['params'] ?? [];
        
        return $this->templateHook->display($hookName, $hookParams);
    }
    
    public function smartyHookBlock($params, $content, $smarty, &$repeat)
    {
        if (!$repeat) {
            $hookName = $params['name'] ?? '';
            $hookParams = $params['params'] ?? [];
            $hookParams['content'] = $content;
            
            $results = $this->hooks->execWithReturn($hookName, $hookParams);
            return implode('', $results);
        }
    }
    
    private function loadCoreHooks()
    {
        // Load hook files from app/hooks directory
        $hookPath = APP_PATH . '/hooks/';
        if (is_dir($hookPath)) {
            $hookFiles = glob($hookPath . '*.php');
            
            foreach ($hookFiles as $hookFile) {
                require_once $hookFile;
                
                $className = pathinfo($hookFile, PATHINFO_FILENAME);
                if (class_exists($className)) {
                    $hookInstance = new $className();
                    if (method_exists($hookInstance, 'registerHooks')) {
                        $hookInstance->registerHooks($this->hooks);
                    }
                }
            }
        }
    }
    
    public function run()
    {
        try {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $method = $_SERVER['REQUEST_METHOD'];
            
            $route = $this->router->route($uri, $method);
            
            list($controllerName, $actionName) = explode('@', $route['controllerAction']);
            
            // Execute before controller hook
            $this->hooks->exec('beforeController', [
                'controller' => $controllerName,
                'action' => $actionName,
                'params' => $route['params']
            ]);
            
            $controllerFile = APP_PATH . "/controllers/{$controllerName}.php";
            
            if (!file_exists($controllerFile)) {
                throw new Exception("Controller not found: {$controllerName}");
            }
            
            require_once $controllerFile;
            
            if (!class_exists($controllerName)) {
                throw new Exception("Controller class not found: {$controllerName}");
            }
            
            $controller = new $controllerName();
            
            if (!method_exists($controller, $actionName)) {
                throw new Exception("Action not found: {$actionName} in {$controllerName}");
            }
            
            // Execute action with parameters
            call_user_func_array([$controller, $actionName], $route['params']);
            
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }
    
    private function handleError(Exception $e)
    {
        // Execute error hook
        $this->hooks->exec('onError', [
            'exception' => $e,
            'uri' => $_SERVER['REQUEST_URI'] ?? ''
        ]);
        
        http_response_code(500);
        echo "Error: " . $e->getMessage();
        
        // Log error
        error_log("Framework Error: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
    }
    
    // Instance method for Mailer
    private function getMailerInstance()
    {
        if ($this->mailer === null) {
            // Load Mailer class if needed
            if (!class_exists('Mailer')) {
                require_once __DIR__ . '/Mailer.php';
            }
            $this->mailer = new Mailer();
        }
        return $this->mailer;
    }
    
    // Getters
    public static function getSmarty() { return self::getInstance()->smarty; }
    public static function getHooks() { return self::getInstance()->hooks; }
    public static function getRouter() { return self::getInstance()->router; }
    public static function getDatabase() { return self::getInstance()->db; }
    public static function getTemplateHook() { return self::getInstance()->templateHook; }
    public static function getMailer() { return self::getInstance()->getMailerInstance(); }
}