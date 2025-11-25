<?php
// Define constants FIRST
define( 'ROOT_PATH', dirname(__DIR__));
define( 'APP_PATH', ROOT_PATH . '/app');
define( 'CORE_PATH', ROOT_PATH . '/core');
define( 'PUBLIC_PATH', __DIR__);
define( 'CONFIG_PATH', ROOT_PATH . '/config');

// Load configuration (defines DB_HOST, DB_NAME, etc.)
require_once CONFIG_PATH . '/config.php';

// Include Composer autoload if exists
if ( file_exists( ROOT_PATH . '/vendor/autoload.php' ) ) {
    require_once ROOT_PATH . '/vendor/autoload.php';
}

// Load core classes manually in correct order
require_once CORE_PATH . '/Database.php';
require_once CORE_PATH . '/HookManager.php';
require_once CORE_PATH . '/Router.php';
require_once CORE_PATH . '/Controller.php';
require_once CORE_PATH . '/Model.php';
require_once CORE_PATH . '/TemplateHook.php';
require_once CORE_PATH . '/Framework.php';

// Get the router instance
$router = Framework::getRouter();

// ==================== DEFINE YOUR ROUTES HERE ====================

// Basic routes
$router->addRoute( 'GET', '/', 'HomeController@index' );
$router->addRoute( 'GET', '/about', 'HomeController@about' );
$router->addRoute( 'GET', '/contact', 'HomeController@contact' );

// Product routes
$router->addRoute( 'GET', '/products', 'ProductController@index' );
$router->addRoute( 'GET', '/product/{id}', 'ProductController@show' );

// User routes
$router->addRoute( 'GET', '/register', 'UserController@registerForm' );
$router->addRoute( 'POST', '/register', 'UserController@register' );
$router->addRoute( 'GET', '/login', 'UserController@loginForm' );
$router->addRoute( 'POST', '/login', 'UserController@login' );

// 404 route should be last
$router->addRoute( 'GET', '/{any}', 'ErrorController@notFound' );

// ==================== START THE APPLICATION ====================
Framework::getInstance()->run();