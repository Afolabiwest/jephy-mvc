<?php
/* Smarty version 4.5.6, created on 2025-11-24 17:51:05
  from 'C:\xampp\htdocs\jephy\website\app\views\about.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_69248cf9c90019_77072914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc44f088462acad5c24b238b4010ac236d7e8bdd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\jephy\\website\\app\\views\\about.tpl',
      1 => 1764002210,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69248cf9c90019_77072914 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'About' ?? null : $tmp);?>
</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'About Us' ?? null : $tmp);?>
</h1>
        <p><?php echo (($tmp = $_smarty_tpl->tpl_vars['content']->value ?? null)===null||$tmp==='' ? 'This is the about page.' ?? null : $tmp);?>
</p>
        <a href="/">← Back to Home</a>
        
        <footer>
            &copy; <?php echo (($tmp = $_smarty_tpl->tpl_vars['current_year']->value ?? null)===null||$tmp==='' ? 2024 ?? null : $tmp);?>
 <?php echo (($tmp = $_smarty_tpl->tpl_vars['base_url']->value ?? null)===null||$tmp==='' ? 'http://localhost' ?? null : $tmp);?>

        </footer>
    </div>
</body>
</html><?php }
}
