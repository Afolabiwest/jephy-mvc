<?php

// In AnalyticsHooks.php
class AnalyticsHooks
{
    public function registerHooks($hooks)
    {
        $hooks->registerHook('beforeRender', [$this, 'addAnalytics']);
    }
    
    public function addAnalytics($params)
    {
        $smarty = Framework::getSmarty();
        $smarty->assign('google_analytics_code', 'GA-123456');
        return $params;
    }
}