<?php
class DisplayHooks
{
    public function registerHooks(HookManager $hooks)
    {
        // Register hooks with different priorities
        $hooks->registerHook('beforeRender', [$this, 'addGlobalVariables'], 5);
        $hooks->registerHook('homepageData', [$this, 'modifyHomepageData'], 10);
    }
    
    public function addGlobalVariables($params)
    {
        $smarty = Framework::getSmarty();
        
        // Add global variables available in ALL templates
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('current_year', date('Y'));
        $smarty->assign('app_name', APP_NAME);
        
        return $params;
    }
    
    public function modifyHomepageData($data)
    {
        // Add/modify data specifically for homepage
        $data['welcome_message'] = '🚀 Modified by hook! 🚀';
        $data['current_time'] = date('Y-m-d H:i:s');
        $data['visitor_count'] = 12345;
        
        return $data;
    }
}