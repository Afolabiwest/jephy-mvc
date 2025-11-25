<?php
/* Smarty version 4.5.6, created on 2025-11-24 17:50:51
  from 'C:\xampp\htdocs\jephy\website\app\views\products\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_69248cebd4c8f7_20569454',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2599f35f944903ceb6d2f8a66072aa11ad46e83' => 
    array (
      0 => 'C:\\xampp\\htdocs\\jephy\\website\\app\\views\\products\\index.tpl',
      1 => 1764002762,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69248cebd4c8f7_20569454 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Products' ?? null : $tmp);?>
</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin: 20px 0; }
        .product-card { border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        .product-card h3 { margin-top: 0; }
        .price { font-size: 1.2em; color: #2c5aa0; font-weight: bold; }
        .btn { display: inline-block; padding: 10px 15px; background: #2c5aa0; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? 'Our Products' ?? null : $tmp);?>
</h1>
        <a href="/">← Back to Home</a>

        <div class="products-grid">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <div class="product-card">
                <h3><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</h3>
                <p class="price">$<?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</p>
                <p><?php echo $_smarty_tpl->tpl_vars['product']->value['description'];?>
</p>
                <a href="/product/<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
" class="btn">View Details</a>
            </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>

        <footer>
            &copy; <?php echo (($tmp = $_smarty_tpl->tpl_vars['current_year']->value ?? null)===null||$tmp==='' ? 2024 ?? null : $tmp);?>
 <?php echo (($tmp = $_smarty_tpl->tpl_vars['base_url']->value ?? null)===null||$tmp==='' ? 'http://localhost' ?? null : $tmp);?>

        </footer>
    </div>
</body>
</html><?php }
}
