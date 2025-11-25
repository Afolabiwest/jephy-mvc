<?php
abstract class Controller
{
    protected $smarty;
    protected $hooks;
    
    public function __construct()
    {
        $this->smarty = Framework::getSmarty();
        $this->hooks = Framework::getHooks();
    }
    
    protected function render($template, $data = [])
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        
        // Execute hooks before rendering
        $this->hooks->exec('beforeRender', [
            'template' => $template,
            'data' => $data
        ]);
        
        return $this->smarty->fetch($template);
    }
    
    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}