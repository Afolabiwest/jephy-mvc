<!DOCTYPE html>
<html>
<head>
    <title>{$title|default:'Product Details'}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
        .product-detail { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin: 20px 0; }
        .product-info h1 { margin-top: 0; }
        .price { font-size: 1.5em; color: #2c5aa0; font-weight: bold; }
        .btn { display: inline-block; padding: 10px 15px; background: #2c5aa0; color: white; text-decoration: none; border-radius: 4px; }
        .features { margin: 20px 0; }
        .features ul { padding-left: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/products">← Back to Products</a>

        <div class="product-detail">
            <div class="product-image">
                <img src="https://via.placeholder.com/400x300?text=Product+{$product.id}" alt="{$product.name}" style="width: 100%; border-radius: 8px;">
            </div>
            
            <div class="product-info">
                <h1>{$product.name}</h1>
                <p class="price">${$product.price}</p>
                <p>{$product.description}</p>
                
                <div class="features">
                    <h3>Features:</h3>
                    <ul>
                        {foreach $product.features as $feature}
                        <li>{$feature}</li>
                        {/foreach}
                    </ul>
                </div>
                
                <button class="btn">Add to Cart</button>
            </div>
        </div>

        <footer>
            &copy; {$current_year|default:2024} {$base_url|default:'http://localhost'}
        </footer>
    </div>
</body>
</html>