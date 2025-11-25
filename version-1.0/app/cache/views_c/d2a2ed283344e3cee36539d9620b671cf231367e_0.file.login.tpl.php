<?php
/* Smarty version 4.5.6, created on 2025-11-24 17:50:58
  from 'C:\xampp\htdocs\jephy\website\app\views\users\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_69248cf27c27e0_68440675',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2a2ed283344e3cee36539d9620b671cf231367e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\jephy\\website\\app\\views\\users\\login.tpl',
      1 => 1764002936,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69248cf27c27e0_68440675 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Login' ?? null : $tmp);?>
</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 400px; margin: 0 auto; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #2c5aa0; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Login' ?? null : $tmp);?>
</h1>
        <a href="/">← Back to Home</a>

        <form id="loginForm">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="/register">Register here</a></p>

        <footer>
            &copy; <?php echo (($tmp = $_smarty_tpl->tpl_vars['current_year']->value ?? null)===null||$tmp==='' ? 2024 ?? null : $tmp);?>
 <?php echo (($tmp = $_smarty_tpl->tpl_vars['base_url']->value ?? null)===null||$tmp==='' ? 'http://localhost' ?? null : $tmp);?>

        </footer>
    </div>

    <?php echo '<script'; ?>
>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('/login', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                } else {
                    alert(data.message || 'Login failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Login failed');
            });
        });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
