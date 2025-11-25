<?php
/* Smarty version 4.5.6, created on 2025-11-24 17:51:08
  from 'C:\xampp\htdocs\jephy\website\app\views\contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_69248cfc1beff0_11618352',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d7815f59eb86551395ce0cc61a3979cb192bf1d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\jephy\\website\\app\\views\\contact.tpl',
      1 => 1764002226,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69248cfc1beff0_11618352 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Contact' ?? null : $tmp);?>
</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Contact Us' ?? null : $tmp);?>
</h1>
        <p>Contact form would go here.</p>
        <a href="/">← Back to Home</a>
        
        <footer>
            &copy; <?php echo (($tmp = $_smarty_tpl->tpl_vars['current_year']->value ?? null)===null||$tmp==='' ? 2024 ?? null : $tmp);?>
 <?php echo (($tmp = $_smarty_tpl->tpl_vars['base_url']->value ?? null)===null||$tmp==='' ? 'http://localhost' ?? null : $tmp);?>

        </footer>
    </div>
</body>
</html><?php }
}
