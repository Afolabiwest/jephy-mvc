<?php
class Router
{
    private $routes = [];
    private $hooks;
    
    public function __construct(HookManager $hooks)
    {
        $this->hooks = $hooks;
    }
    
    public function addRoute($method, $path, $controllerAction)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controllerAction' => $controllerAction
        ];
    }
    
    public function route($uri, $method)
    {
        // Remove query string
        $uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $uri);
        
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }
            
            $pattern = $this->convertToRegex($route['path']);
            
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove full match
                
                // Execute before routing hook
                $this->hooks->exec('beforeRoute', [
                    'route' => $route,
                    'uri' => $uri,
                    'method' => $method
                ]);
                
                return [
                    'controllerAction' => $route['controllerAction'],
                    'params' => $matches
                ];
            }
        }
        
        throw new Exception('Route not found: ' . $uri);
    }
    
    private function convertToRegex($path)
    {
        $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '([^/]+)', $path);
        return '#^' . $pattern . '$#';
    }
}