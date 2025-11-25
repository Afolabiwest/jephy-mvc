<?php
/* Smarty version 4.5.6, created on 2025-11-24 17:51:09
  from 'C:\xampp\htdocs\jephy\website\app\views\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_69248cfdb594c1_14164355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e39466ee97770d8cf76208fc854f7524a7210841' => 
    array (
      0 => 'C:\\xampp\\htdocs\\jephy\\website\\app\\views\\home.tpl',
      1 => 1764002151,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69248cfdb594c1_14164355 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Welcome' ?? null : $tmp);?>
</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Welcome to Our Framework' ?? null : $tmp);?>
</h1>
        <p><?php echo (($tmp = $_smarty_tpl->tpl_vars['message']->value ?? null)===null||$tmp==='' ? 'Hello from our custom MVC framework!' ?? null : $tmp);?>
</p>
        
                <p>Welcome message: <?php echo (($tmp = $_smarty_tpl->tpl_vars['welcome_message']->value ?? null)===null||$tmp==='' ? 'Default welcome message' ?? null : $tmp);?>
</p>
        <p>Current time: <?php echo (($tmp = $_smarty_tpl->tpl_vars['current_time']->value ?? null)===null||$tmp==='' ? 'Time not available' ?? null : $tmp);?>
</p>
        
        <nav>
            <a href="/">Home</a> | 
            <a href="/about">About</a> | 
            <a href="/contact">Contact</a> |
            <a href="/products">Products</a> |
            <a href="/register">Register</a> |
            <a href="/login">Login</a>
        </nav>
        
        <footer>
            &copy; <?php echo (($tmp = $_smarty_tpl->tpl_vars['current_year']->value ?? null)===null||$tmp==='' ? 2024 ?? null : $tmp);?>
 <?php echo (($tmp = $_smarty_tpl->tpl_vars['base_url']->value ?? null)===null||$tmp==='' ? 'http://localhost' ?? null : $tmp);?>

        </footer>
    </div>
</body>
</html><?php }
}
