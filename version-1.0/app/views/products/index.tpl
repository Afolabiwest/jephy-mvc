<!DOCTYPE html>
<html>
<head>
    <title>{$title|default:'Products'}</title>
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
        <h1>{$title|default:'Our Products'}</h1>
        <a href="/">← Back to Home</a>

        <div class="products-grid">
            {foreach $products as $product}
            <div class="product-card">
                <h3>{$product.name}</h3>
                <p class="price">${$product.price}</p>
                <p>{$product.description}</p>
                <a href="/product/{$product.id}" class="btn">View Details</a>
            </div>
            {/foreach}
        </div>

        <footer>
            &copy; {$current_year|default:2024} {$base_url|default:'http://localhost'}
        </footer>
    </div>
</body>
</html>