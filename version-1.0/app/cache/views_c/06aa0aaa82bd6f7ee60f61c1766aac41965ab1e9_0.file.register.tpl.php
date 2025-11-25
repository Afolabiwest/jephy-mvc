<?php
/* Smarty version 4.5.6, created on 2025-11-24 17:50:54
  from 'C:\xampp\htdocs\jephy\website\app\views\users\register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_69248cee72d6e6_17446646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06aa0aaa82bd6f7ee60f61c1766aac41965ab1e9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\jephy\\website\\app\\views\\users\\register.tpl',
      1 => 1764002864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69248cee72d6e6_17446646 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Register' ?? null : $tmp);?>
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
        <h1><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Create Account' ?? null : $tmp);?>
</h1>
        <a href="/">← Back to Home</a>

        <form id="registerForm">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="/login">Login here</a></p>

        <footer>
            &copy; <?php echo (($tmp = $_smarty_tpl->tpl_vars['current_year']->value ?? null)===null||$tmp==='' ? 2024 ?? null : $tmp);?>
 <?php echo (($tmp = $_smarty_tpl->tpl_vars['base_url']->value ?? null)===null||$tmp==='' ? 'http://localhost' ?? null : $tmp);?>

        </footer>
    </div>

    <?php echo '<script'; ?>
>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('/register', {
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
                    alert(data.message || 'Registration failed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Registration failed');
            });
        });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
